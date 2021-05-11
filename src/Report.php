<?php

namespace Magento;

require_once(__DIR__ . '/Mailer.php');

class Report {

    public $title;
    public $date;
    public $content;

    public function __construct($title = '', $date = NULL, $content = '') {
        $this->title = $title;
        $this->date = ($date) ?? (new \DateTime())->format('y-m-d h:i:s');
        $this->content = $content;
    }

    public function validate(): bool {
        if (empty($this->title) || empty($this->date) || empty($this->content)) {
            return false;
        }
        return true;
    }

    public function formatJson(): string {
        $jsonObj = json_encode($this->reportToArray());
        return $jsonObj;
    }

    public function reportToArray(): array {
        $reportArr = [
            'title' => $this->title,
            'date' => $this->date,
            'content' => $this->content
        ];
        return $reportArr;
    }

    public function formatHtml(): string {
        return "
            <h1>{$this->title}</h1> .
            <p>{$this->date}</p> .
            <div class='content'>{$this->content}</div> .
        ";
    }

    public function sendReport($type): bool {
        if($this->validate()) {
            if(!empty($type) && !empty($this->title) && !empty($this->date) && !empty($this->content)) {
                switch($type) {
                    case 'HTML':
                        $mailer = new Mailer();
                        $mailer->send($this->formatHtml());
                        break;
                    case 'JSON':
                        $mailer = new Mailer();
                        $mailer->send($this->formatJson());
                        break;
                    default:
                        break;
                }

                return true;
            }

            return false;            
        }

        return false;
    }
}

/*
$obj = new Report('My Readings', '21-05-11 04:35:07', 'Test Content');

$output1 = $obj->validate();
$output2 = $obj->formatJson();
$output3 = $obj->reportToArray();
$output4 = $obj->formatHtml();
$output5 = $obj->sendReport('JSON');

echo '<pre>'; 
print_r($output1);
print_r($output2);
print_r($output3);
print_r($output4);
print_r($output5); 
exit;
die;
*/
