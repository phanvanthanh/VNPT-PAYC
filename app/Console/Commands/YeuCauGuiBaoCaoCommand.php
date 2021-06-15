<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Helper;

class YeuCauGuiBaoCaoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yeucauguibaocao';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lệnh này yêu cầu các đơn vị gửi báo cáo tuần mỗi 16:30 thứ 6 hàng tuần';

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
        $success=Helper::sendTelegramMessage('check gửi thông báo tự động');
    }
}
