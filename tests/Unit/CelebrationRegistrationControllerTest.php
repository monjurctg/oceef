<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\CelebrationRegistrationController;

class CelebrationRegistrationControllerTest extends TestCase
{
    /** @test */
    public function calculate_amount_correctly_computes_total_for_single_registration()
    {
        $controller = new CelebrationRegistrationController();

        // Test single registration (1 person)
        $amount = $this->invokeMethod($controller, 'calculateAmount', [0, 0, false]);
        $this->assertEquals(1500, $amount);
    }

    /** @test */
    public function calculate_amount_correctly_computes_total_with_family_members()
    {
        $controller = new CelebrationRegistrationController();

        // Test with 1 additional family member (2 people total)
        $amount = $this->invokeMethod($controller, 'calculateAmount', [1, 0, false]);
        $this->assertEquals(2500, $amount); // 1500 + 1000

        // Test with 2 additional family members (3 people total)
        $amount = $this->invokeMethod($controller, 'calculateAmount', [2, 0, false]);
        $this->assertEquals(3500, $amount); // 1500 + 2000
    }

    /** @test */
    public function calculate_amount_correctly_computes_total_with_driver()
    {
        $controller = new CelebrationRegistrationController();

        // Test single registration with driver
        $amount = $this->invokeMethod($controller, 'calculateAmount', [0, 0, true]);
        $this->assertEquals(2000, $amount); // 1500 + 500

        // Test with family members and driver
        $amount = $this->invokeMethod($controller, 'calculateAmount', [1, 0, true]);
        $this->assertEquals(3000, $amount); // 1500 + 1000 + 500
    }

    /** @test */
    public function calculate_amount_correctly_handles_children()
    {
        $controller = new CelebrationRegistrationController();

        // Test with children (should be free)
        $amount = $this->invokeMethod($controller, 'calculateAmount', [0, 3, false]);
        $this->assertEquals(1500, $amount); // Children are free

        // Test with family members and children
        $amount = $this->invokeMethod($controller, 'calculateAmount', [2, 2, false]);
        $this->assertEquals(3500, $amount); // 1500 + 2000 + 0
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    protected function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}