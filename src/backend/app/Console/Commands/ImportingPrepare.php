<?php

namespace App\Console\Commands;

use App\Entities\Input;
use App\Entities\OutputEntry;
use App\Repositories\EmailRepository;
use App\Repositories\FilterRepository;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportingPrepare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:prepare {input}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare a DB input to be imported';

    /**
     * Execute the console command.
     *
     * @param EmailRepository  $emailRepository
     * @param FilterRepository $filterRepository
     *
     * @return int
     * @throws \JsonException
     */
    public function handle(EmailRepository $emailRepository, FilterRepository $filterRepository): int
    {
        $input = $this->readInput($this->argument('input'));

        $filters = [];
        foreach ($input->headers as $i => $filterName) {
            if ($i === 0) {
                continue;
            }

            $filters[] = $filterRepository->findByEnglishName($filterName);
        }

        $records = [];
        foreach ($input->contents as $row) {
            $email = $emailRepository->findByEmail($row[0]);
            $record = new OutputEntry();
            $record->id = $email->id;

            foreach ($row as $i => $value) {
                if ($i === 0) {
                    continue;
                }

                $filter = $filters[$i - 1];
                $attribute = $filter->values->where('englishValue', '=', $value)->first();

                if (!$attribute) {
                    $attribute = $filter->values->where('frenchValue', '=', $value)->first();
                }

                $record->attributes[] = $attribute;
            }

            $records[] = $record;
        }

        $outputPath = sprintf('prepared/%s.json', (new DateTime())->getTimestamp());
        Storage::disk('local')->put($outputPath, json_encode($records, JSON_THROW_ON_ERROR));

        $this->info(sprintf('Prepared output generated at %s', $outputPath));

        return 0;
    }

    /**
     * @param string $path
     *
     * @return Input
     */
    protected function readInput(string $path): Input
    {
        $input = new Input();
        $input->contents = [];

        $file = fopen($path, 'r');
        while (($data = fgetcsv($file, 1000, ";")) !== false) {
            if (!isset($input->headers)) {
                $input->headers = $data;
                continue;
            }

            $input->contents[] = $data;
        }

        fclose($file);

        return $input;
    }
}
