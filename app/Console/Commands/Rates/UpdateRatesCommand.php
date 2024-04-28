<?php

namespace App\Console\Commands\Rates;

use Exception;
use Illuminate\Console\Command;
use App\Factories\Services\ServiceFactory;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Command\Command as CommandCode;

class UpdateRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is utilized daily to update rates within a database.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->output->progressStart(5);

        try {
            $currencyRateService = ServiceFactory::makeCurrencyRateService();
        } catch (Exception $e) {
            $this->error($e->getMessage());
            Log::channel('currency_rate_command')->error($e->getMessage());
            return CommandCode::FAILURE;
        }
        $this->output->progressAdvance();

        try {
            $responseXML = $currencyRateService->getList();
        } catch (Exception $e) {
            $this->error($e->getMessage());
            Log::channel('currency_rate_command')->error($e->getMessage());
            return CommandCode::FAILURE;
        }
        $this->output->progressAdvance();

        try {
            $parsedItemsIterator = $currencyRateService->parse($responseXML);
        } catch (Exception $e) {
            $this->error($e->getMessage());
            Log::channel('currency_rate_command')->error($e->getMessage());
            return CommandCode::FAILURE;
        }
        $this->output->progressAdvance();

        try {
            $ratesCollection = $currencyRateService->collect($parsedItemsIterator);
        } catch (Exception $e) {
            $this->error($e->getMessage());
            Log::channel('currency_rate_command')->error($e->getMessage());
            return CommandCode::FAILURE;
        }
        $this->output->progressAdvance();

        try {
            $currencyRateService->saveToDB($ratesCollection);
        } catch (Exception $e) {
            $this->error($e->getMessage());
            Log::channel('currency_rate_command')->error($e->getMessage());
            return CommandCode::FAILURE;
        }
        $this->output->progressAdvance();

        $this->output->progressFinish();
        $this->alert('Command finished successfully, all currencies has been updated.');

        return CommandCode::SUCCESS;
    }
}
