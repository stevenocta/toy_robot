<?php
namespace Toy\Robot;
include 'classes/Robot.php';

use PHPUnit\Framework\TestCase;


/**
 * API Handler Test Cases
 *
 * @author Steven Gunarso
 */
final class Robot_Test extends TestCase
{
    /**
     * @var Robot $robot Robot class instance to be tested
     */
    private $robot;

    /**
     * @var array $first_scenario_expected The expected output of the first test scenario
     */
    private $first_scenario_expected;

    /**
     * @var array $second_scenario_expected The expected output of the second test scenario
     */
    private $second_scenario_expected;

    /**
     * @var array $third_scenario_expected The expected output of the third test scenario
     */
    private $third_scenario_expected;

    /**
     * @var array $max_boundary_testing_expected The expected output of the maximum boundary testing
     */
    private $max_boundary_testing_expected;

    /**
     * @var array $min_boundary_testing_expected The expected output of the minimum boundary testing
     */
    private $min_boundary_testing_expected;

    /**
     * @var array $placement_boundary_expected The expected output of the placement boundary testing
     */
    private $placement_boundary_expected;
    

    /**
     * Test Set Up function
     * Set-up the required variables for the testing
     * @return void
     */
    public function setUp(): void
    {
        $this->robot = new Robot();

        $this->first_scenario_expected = array(
            'X' => 0,
            'Y' => 1,
            'Facing' => 'NORTH'
        );

        $this->second_scenario_expected = array(
            'X' => 0,
            'Y' => 0,
            'Facing' => 'WEST'
        );

        $this->third_scenario_expected = array(
            'X' => 3,
            'Y' => 3,
            'Facing' => 'NORTH'
        );

        $this->max_boundary_testing_expected = array(
            'X' => 4,
            'Y' => 4,
            'Facing' => 'NORTH'
        );

        $this->min_boundary_testing_expected = array(
            'X' => 0,
            'Y' => 0,
            'Facing' => 'WEST'
        );

        $this->placement_boundary_expected = array(
            'X' => 2,
            'Y' => 2,
            'Facing' => 'NORTH'
        );
    }

    /**
     * Test the first scenario specified on the requirements (normal place then move)
     * place(0, 0, NORTH) -> move -> report
     * @return void
     */
    public function test_first_scenario(): void
    {
        $this->robot->place( 0, 0, $this->robot::NORTH );
        $this->robot->move();
        $results = $this->robot->report();

        $this->assertSame($this->first_scenario_expected, $results);
    }

    /**
     * Test the second scenario specified on the requirements (changing the robot facing without movements)
     * place(0, 0, NORTH) -> left
     * @return void
     */
    public function test_second_scenario(): void
    {
        $this->robot->place( 0, 0, $this->robot::NORTH );
        $this->robot->left();
        $results = $this->robot->report();

        $this->assertSame($this->second_scenario_expected, $results);
    }

    /**
     * Test the third scenario specified on the requirements (changing the Robot facing and move)
     * place(1, 2, EAST) -> move -> move -> left -> move
     * @return void
     */
    public function test_third_scenario(): void
    {
        $this->robot->place( 1, 2, $this->robot::EAST );
        $this->robot->move();
        $this->robot->move();

        $this->robot->left();

        $this->robot->move();

        $results = $this->robot->report();

        $this->assertSame($this->third_scenario_expected, $results);
    }

    /**
     * Test the nothern and eastern boundaries of the board
     * place(3, 3, EAST) -> move -> move -> left -> move -> move
     * @return void
     */
    public function test_max_boundary(): void
    {
        $this->robot->place( 3, 3, $this->robot::EAST );
        $this->robot->move();
        // this should not move the Robot, as it will fall off the eastern limits of the board
        $this->robot->move();

        $this->robot->left();

        $this->robot->move();
        // this should not move the Robot, as it will fall off the northern limits of the board
        $this->robot->move();
        
        $results = $this->robot->report();

        $this->assertSame($this->max_boundary_testing_expected, $results);
    }

    /**
     * Test the southern and western boundaries of the board
     * place(1, 1, SOUTH) -> move -> move -> right -> move -> move
     * @return void
     */
    public function test_min_boundary(): void
    {
        $this->robot->place( 1, 1, $this->robot::SOUTH );
        $this->robot->move();
        // this should not move the Robot, as it will fall off the southern limits of the board
        $this->robot->move();

        $this->robot->right();

        $this->robot->move();
        // this should not move the Robot, as it will fall off the western limits of the board
        $this->robot->move();
        
        $results = $this->robot->report();

        $this->assertSame($this->min_boundary_testing_expected, $results);
    }

    /**
     * Test the Robot placement "boundaries" as the Robot should not move when it has not even been placed
     *  move -> left -> move -> right -> move -> place(2, 2, NORTH)
     * @return void
     */
    public function test_placement_boundary(): void
    {
        // none of these should do anything
        $this->robot->move();
        $this->robot->left();
        $this->robot->move();
        $this->robot->right();
        $this->robot->move();

        // place the robot now
        $this->robot->place( 2, 2, $this->robot::NORTH );
        
        $results = $this->robot->report();

        $this->assertSame($this->placement_boundary_expected, $results);
    }
}