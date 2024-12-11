<?php 
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailCreateToken extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data; // Truyền dữ liệu vào email
    }

    public function build()
    {
        return $this->view('Api.mail.store') // Sử dụng Blade view
                    ->with('data', $this->data) // Gửi dữ liệu tới view
                    ->subject('Thông báo từ hệ thống tạo API Token'); // Đặt tiêu đề email
    }
}
