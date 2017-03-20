<?php

namespace Env\Commands;

use Illuminate\Console\Command;

class EnvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:generate {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modify env file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $key = $this->argument('key');
        $arr = explode('=',$key);
        if(count($arr)<2) die('key=value?');
        $cmd    = $arr[0];unset($arr[0]);
        $value  = implode('',$arr);
        if( env($cmd,null)===null ) die('key Can"t find');

        $odlCmd = $this->toStringCmd(env($cmd));
        $value  = $this->toStringCmd($value);
        $str = str_replace(
            $cmd.'='.$odlCmd,
            $cmd.'='.$value,
            file_get_contents(base_path('.env'))
        );
        $str = str_replace(
            $cmd.'="'.$odlCmd.'""',
            $cmd.'="'.$value.'""',
            $str
        );
        file_put_contents(base_path('.env'), $str);
    }

    /**
     * 特殊值转换
     *
     * @param $cmd
     * @return string
     */
    public function toStringCmd($cmd)
    {
        if( $cmd===true ){
            return 'true';
        }
        if( $cmd===false ){
            return 'false';
        }
        return $cmd;
    }
}
