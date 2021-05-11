<?php

namespace Magento\Test;

class ReportTest extends PHPUnit\Framework\TestCase {

   private $report;

   protected function setUp() {
      $this->report = new App\Report('My Title', '21-05-11 03:25:00', 'My Content');
   }
    
   public function testValidate() {
      
      //$calculator = new App\Calculator;
      $result = $this->report->validate();
      $this->assertEquals(1, $result);
   }
}
