<?php

namespace App\Console\Commands;

use App\Shop;
use Illuminate\Console\Command;

class ImportShops extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shops.csv:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data in database';

    /**
     * instance Shop Model
     * @var Shop
     */
    protected $shop;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        if($handle = fopen(base_path() . '\storage\uploads\shops',"r")){
            while ($data = fgetcsv($handle,1000,","))
            {
                $this->shop = new Shop;
                $this->shop->regionId = $data[0];
                $this->shop->title = $data[1];
                $this->shop->city =  $data[2];
                $this->shop->address= $data[3];
                $this->shop->userId = $data[4];
                $this->shop->save();
            }
            fclose($handle);
            $this->info('Import Successfully');
        }
    }
}
