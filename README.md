# Test Repository

## Application Overviews
The main class to be utilised is the Robot class, which process the current state of the Robot.
The Robot instance will keep track of whether the robot has been placed, its facing and movements.

Since there is graphical interface required by the requirements, the Robot class will also perform checking on the Board states.
This includes keeping track of the Board boundaries as well as the robot positioning on the board.


## How to Run
Please run this repository with PHP 7.3 or above due to the PHPUnit and Namespace structure.

The application index.php will run automatically once the directory is executed using PHP.
E.g. with localhost as the root and directory "/toy_robot/", please run "http://localhost/toy_robot/" to run the codes.

The index.php will automatically run the 3 specified scenarios on the requirements and output the reports to screen as var_dumps. 


## How to Run Testing with PHPUnit
Please run this repository with PHP Unit 9 or above.

The PHPUnit XML file is set up on the root directory of the application.
Please navigate to the directory where the PHPUnit XML is located and run "phpunit" from the command line / bash.

There are 6 assertions contained within the Robot test class located on the "tests" folder.
All of them should be a positive (successful) assertions with mocked data inputs.


## Code Functions Overviews
The Robot class has a number of vital functions, namely:
- Robot::place() activates the Robot class, any operations performed before actually placing the Robot would be have no effects.
- Robot::left() / Robot::right() change the facing of the robot, the internal calculations is utilising a 360 degrees calculations.
- Robot::move() commands the Robot to move forward one step according to its facing, it will return invalid if the Robot detects that it will fall outside the board.
- Robot::report() returns the array representations of the Robot positions, as well as its facing.


## Known Issues
- Utilising PHP 7.2.x with this repository will probably cause an error, due to Namespace bug on the PHP version.
- Utilising PHP 5.4.0 and below might cause the system to encounter errors due to PHP codes versioning.