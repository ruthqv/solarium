<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use Solarium\Client;


class BuiltSolrCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'solr:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for index Solr Models';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $client;

    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    public function handle()
    {
        $this->info('Indexing all clients. Might take a while...');
        $products = Product::all();

        foreach ($products as $key=>$value)
        {
            $val = collect($value);
            $update = $this->client->createUpdate();
            $doc = $update->createDocument(); 
             
            foreach($val as $k=>$v){
               $doc['' .$k. ''] = $v;
            } 

            $update->addDocument($doc);
            $update->addCommit();
            $result = $this->client->update($update);
   
        }
        // PHPUnit-style feedback
        // $this->output->write(var_dump($doc));
        $this->info("\nDone!");

    }
}
