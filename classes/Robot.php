<?php
namespace Toy\Robot;
/**
 * Robot Class
 * Description: Simulate Robot in a 5x5 table.
 * Author: Steven Gunarso
 * Version: 1.0.0
 * PHP requires at least: 5.4.0
 * PHP tested with: 7.3.12 
 */
class Robot {

	private $x_pos, $y_pos, $facing, $placement;

	const NORTH = 0;
	const EAST 	= 90;
	const SOUTH = 180;
	const WEST 	= 270;

	const LEFT = -90;
	const RIGHT = 90;

	//Constant is used since there is no requirements to change the table size 
	const TABLE_SIZE_X = 5;
	const TABLE_SIZE_Y = 5;

	/**
	 * Class constructor. Called when an object of this class is instantiated.
	 * 
	 * @since	1.0.0
	 * @uses	self::set_placement()
	 */
	public function __construct() {
		$this->set_placement(false);
	}

	/**
	 * Place Function. Place the Robot Positions
	 * 
	 * @since	1.0.0
	 * @param	string	$x_pos		Initial X Position of the Robot
	 * @param	string	$y_pos		Initial Y Position of the Robot
	 * @param	string	$facing		Facing direction according to the pre-determined constants
	 * @uses	self::set_x_pos()
	 * @uses	self::set_y_pos()
	 * @uses	self::set_facing()
	 * @uses	self::set_placement()
	 */
	public function place($x_pos = 0, $y_pos = 0, $facing = self::NORTH) {
		$this->set_x_pos($x_pos);
		$this->set_y_pos($y_pos);
		$this->set_facing($facing);

		$this->set_placement(true);

		return false;
	}

	/**
	 * Left Function. Change the facing of the Robot counter-clockwise
	 * 
	 * @since	1.0.0
	 * @return	bool 	Direction Change Status
	 * @uses	self::set_facing()
	 */
	public function left() {

		if( !$this->placement ) {
			return false;
		}

		//anticipate 0 to -90 facing
		if( $this->facing + self::LEFT < 0 ) {
			$this->set_facing( 360 + self::LEFT );
			return true;
		}
		else {
			$this->set_facing( $this->facing + self::LEFT );
			return true;
		}

		return false;
	}

	/**
	 * Right Function. Change the facing of the Robot clockwise
	 * 
	 * @since	1.0.0
	 * @return	bool 	Direction Change Status
	 * @uses	self::set_facing()
	 */
	public function right() {

		if( !$this->placement ) {
			return false;
		}

		//anticipate 270 to 0 facing
		if( $this->facing + self::RIGHT > self::WEST ) {
			$this->set_facing( self::NORTH );
		}
		else {
			$this->set_facing( $this->facing + self::RIGHT );
		}

		return false;
	}

	/**
	 * Move Function. Advance the robot by one block relative to the "facing" direction
	 * 
	 * @since	1.0.0
	 * @return 	bool 	Status Results of the movement
	 * @uses	self::set_x_pos()
	 * @uses	self::set_y_pos()
	 */
	public function move() {

		if( !$this->placement ) {
			return false;
		}

		if( $this->facing == self::NORTH ) {
			//vertical + 1 movement
			$this->set_y_pos( $this->y_pos + 1);
			return true;
		}
		else if( $this->facing == self::SOUTH ) {
			//vertical - 1 movement
			$this->set_y_pos( $this->y_pos - 1);
			return true;
		}
		else if( $this->facing == self::WEST ) {
			//horizontal - 1 movement
			$this->set_x_pos( $this->x_pos - 1);
			return true;
		}
		else if( $this->facing == self::EAST ) {
			//horizontal + 1 movement
			$this->set_x_pos( $this->x_pos + 1);
			return true;
		}

		return false;
	}

	/**
	 * Report Function. Returns the current condition of the Robot
	 * 
	 * @since	1.0.0
	 * @return 	array 	Array of X - Y Position and the Facing of the Robot
	 * @uses	self::get_facing_name()
	 */
	public function report() {

		if( !$this->placement ) {
			return false;
		}

		$results = 	array(
						"X" 		=>	$this->x_pos,
						"Y" 		=>	$this->y_pos,
						"Facing" 	=>	$this->get_facing_name()
					);
		return $results;
	}

	/**
	 * Getter Function for X Pos
	 *
	 * @since	1.0.0
	 * @return	int		The current X Position of the Robot
	 **/
	public function get_x_pos() {
		return $this->x_pos;
	}

	/**
	 * Setter Function for X Pos
	 * Validation logic is acceptable within Setter function, hence the usage here
	 * @see: https://stackoverflow.com/questions/20378045/can-i-write-validation-logic-in-setter-methods
	 *
	 * @since	1.0.0
	 * @param	int		The new X Position of the Robot
	 * @uses	intval  Since PHP 4
	 * @used-by self::place()
	 * @used-by self::move()
	 **/
	public function set_x_pos($x_pos = 0) {
		if( intval($x_pos) >= 0 && intval($x_pos) < self::TABLE_SIZE_X ) {
			$this->x_pos = $x_pos;
		}
	}

	/**
	 * Getter Function for Y Pos
	 *
	 * @since	1.0.0
	 * @return	int		The current Y Position of the Robot
	 **/
	public function get_y_pos() {
		return $this->y_pos;
	}

	/**
	 * Setter Function for Y Pos
	 * Validation logic is acceptable within Setter function, hence the usage here
	 * @see: https://stackoverflow.com/questions/20378045/can-i-write-validation-logic-in-setter-methods
	 *
	 * @since	1.0.0
	 * @param	int		The new Y Position of the Robot
	 * @uses	intval  Since PHP 4
	 * @used-by self::place()
	 * @used-by self::move()
	 **/
	public function set_y_pos($y_pos = 0) {
		if( intval($y_pos) >= 0 && intval($y_pos) < self::TABLE_SIZE_Y ) {
			$this->y_pos = $y_pos;
		}
	}

	/**
	 * Getter Function for Facing
	 *
	 * @since	1.0.0
	 * @return	int		The current facing direction of the Robot
	 **/
	public function get_facing() {
		return $this->facing;
	}

	/**
	 * Getter Function for Facing Name
	 * E.g. North
	 *
	 * @since	1.0.0
	 * @return	string		The current facing direction name of the Robot
	 * @used-by self::report()
	 **/
	public function get_facing_name() {
		if( $this->facing == self::EAST ) {
			return "EAST";
		}
		else if( $this->facing == self::SOUTH ) {
			return "SOUTH";
		}
		else if( $this->facing == self::WEST ) {
			return "WEST";
		}
		else {
			return "NORTH";
		}
	}

	/**
	 * Setter Function for Facing
	 *
	 * @since	1.0.0
	 * @param	int		The new facing direction of the Robot
	 * @used-by self::place()
	 * @used-by self::left()
	 * @used-by self::right()
	 **/
	public function set_facing($facing) {
		// Modulus is used to ensure that the inputs are valid angles within increment of 90 degrees 
		if( $facing % 90 == 0 ) {
			$this->facing = $facing % 360;
		}
	}

	/**
	 * Getter Function for Placement Boolean
	 *
	 * @since	1.0.0
	 * @return	bool		The initial placement status
	 **/
	public function get_placement() {
		return $this->placement;
	}

	/**
	 * Setter Function for Placement Boolean
	 *
	 * @since	1.0.0
	 * @param	bool	$placement		The initial placement status
	 * @used-by self::__construct()
	 * @used-by self::place()
	 **/
	public function set_placement($placement) {
		$this->placement = $placement;
	}
}