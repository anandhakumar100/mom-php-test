<?php
declare(strict_types=1);

class ReportTest extends PHPUnit\Framework\TestCase {

   private $report;

   protected function setUp(): void {
      $this->report = new Magento\Report('My Title', '21-05-11 03:25:00', 'My Content');
   }
    
   public function testValidate(): void {  
      // When Properties are defined    
      $obj = new Magento\Report('My Title', '21-05-11 03:25:00', 'My Content');
      $result = $obj->validate();

      $this->assertIsBool($result);
      $this->assertEquals(1, $result);
      $this->assertNotEquals(0, $result);

      // When Properties are not defined
      $obj = new Magento\Report();
      $result = $obj->validate();

      $this->assertIsBool($result);
      $this->assertEquals(0, $result);
      $this->assertNotEquals(1, $result);
   }

   public function testReportToArray(): void {      
      $obj = new Magento\Report('My Title', '21-05-11 03:25:00', 'My Content');
      $result = $obj->reportToArray();

      // When Properties are defined
      $this->assertIsArray($result);
      $this->assertCount(3, $result);

      $this->assertArrayHasKey('title', $result);
      $this->assertArrayHasKey('date', $result);
      $this->assertArrayHasKey('content', $result);

      $this->assertEquals('My Title', $result['title']);
      $this->assertEquals('21-05-11 03:25:00', $result['date']);
      $this->assertEquals('My Content', $result['content']);

      $this->assertNotEquals('My Second Title', $result['title']);
      $this->assertNotEquals('21-05-12 03:25:00', $result['date']);
      $this->assertNotEquals('My Second Content', $result['content']);

      $this->assertContains('My Title', $result);
      $this->assertContains('21-05-11 03:25:00', $result);
      $this->assertContains('My Content', $result);      

      $this->assertNotContains('My Second Title', $result);
      $this->assertNotContains('21-05-12 03:25:00', $result);
      $this->assertNotContains('My Second Content', $result);

      // When Properties are not defined
      $obj = new Magento\Report();
      $result = $obj->reportToArray();

      $this->assertIsArray($result);
      $this->assertCount(3, $result);

      $this->assertArrayHasKey('title', $result);
      $this->assertArrayHasKey('date', $result);
      $this->assertArrayHasKey('content', $result);

      $this->assertEquals('', $result['title']);
      $this->assertEquals('', $result['content']);

      $this->assertNotEquals('My Second Title', $result['title']);
      $this->assertNotEquals('My Second Content', $result['content']);

      $this->assertContains('', $result);
      $this->assertContains('', $result);

      $this->assertNotContains('My Second Title', $result);
      $this->assertNotContains('My Second Content', $result);

   }

   public function testFormatJson(): void {   
      // When Properties are defined   
      $obj = new Magento\Report('My Title', '21-05-11 03:25:00', 'My Content');
      $result = $obj->formatJson();

      $inputArr = [
         'title' => 'My Title',
         'date' => '21-05-11 03:25:00',
         'content' => 'My Content'
      ];

      $this->assertIsString($result);
      $this->assertJsonStringEqualsJsonString(
         json_encode($inputArr),
         $result
      );

      // Convert JSON to Array
      $result = json_decode($result, TRUE);

      $this->assertIsArray($result);
      $this->assertCount(3, $result);

      $this->assertArrayHasKey('title', $result);
      $this->assertArrayHasKey('date', $result);
      $this->assertArrayHasKey('content', $result);

      $this->assertEquals('My Title', $result['title']);
      $this->assertEquals('21-05-11 03:25:00', $result['date']);
      $this->assertEquals('My Content', $result['content']);

      $this->assertNotEquals('My Second Title', $result['title']);
      $this->assertNotEquals('21-05-12 03:25:00', $result['date']);
      $this->assertNotEquals('My Second Content', $result['content']);

      $this->assertContains('My Title', $result);
      $this->assertContains('21-05-11 03:25:00', $result);
      $this->assertContains('My Content', $result);      

      $this->assertNotContains('My Second Title', $result);
      $this->assertNotContains('21-05-12 03:25:00', $result);
      $this->assertNotContains('My Second Content', $result);

      // When Properties are not defined
      $obj = new Magento\Report();
      $result = $obj->formatJson();

      $this->assertIsString($result);

      // Convert JSON to Array
      $result = json_decode($result, TRUE);

      $this->assertIsArray($result);
      $this->assertCount(3, $result);

      $this->assertArrayHasKey('title', $result);
      $this->assertArrayHasKey('date', $result);
      $this->assertArrayHasKey('content', $result);

      $this->assertEquals('', $result['title']);
      $this->assertEquals('', $result['content']);

      $this->assertNotEquals('My Second Title', $result['title']);
      $this->assertNotEquals('My Second Content', $result['content']);

      $this->assertContains('', $result);
      $this->assertContains('', $result);

      $this->assertNotContains('My Second Title', $result);
      $this->assertNotContains('My Second Content', $result);

   }

   public function testFormatHtml(): void {    
      // When Properties are defined  
      $obj = new Magento\Report('My Title', '21-05-11 03:25:00', 'My Content');
      $result = $obj->formatHtml();

      $this->assertIsString($result);          

      // When Properties are not defined
      $obj = new Magento\Report();
      $result = $obj->formatHtml();

      $this->assertIsString($result);

   }

   public function testSendReport(): void {   
      // When Properties are defined - HTML   
      $obj = new Magento\Report(
         'COVID Guidelines', 
         '21-05-11 03:25:00', 
         'Goverment of India imposed lockdown and given new guidelines to be followed across states on friday.'
      );
      $result = $obj->sendReport('HTML');

      $this->assertIsBool($result);
      $this->assertEquals(1, $result);
      $this->assertNotEquals(0, $result);

      // When Properties are defined - JSON
      $obj = new Magento\Report(
         'Union Budget Highlights', 
         '21-05-12 03:25:00', 
         'The highlight of union budget for 2021 is focus on education, healthcare, industries, rural development says finance minister'
      );
      $result = $obj->sendReport('JSON');

      $this->assertIsBool($result);
      $this->assertEquals(1, $result);
      $this->assertNotEquals(0, $result);

      // When Properties are not defined - HTML
      $obj = new Magento\Report();
      $result = $obj->sendReport('HTML');

      $this->assertIsBool($result);
      $this->assertEquals(0, $result);
      $this->assertNotEquals(1, $result);

      // When Properties are not defined - JSON
      $obj = new Magento\Report();
      $result = $obj->sendReport('JSON');

      $this->assertIsBool($result);
      $this->assertEquals(0, $result);
      $this->assertNotEquals(1, $result);
   }

}
