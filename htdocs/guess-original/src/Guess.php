<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */

    private $number;
    private $tries;
    private $gameOver = false;



    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->tries = $tries;
        if ($number == -1) {
            $this->number = $this->random();
        } else {
            $this->number = $number;
        }
    }


    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    
    public function random()
    {
        return rand(1, 99);
    }
    



    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    
    public function tries()
    { 
        return $this->tries;
    }
    



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    
    public function number()
    {
        return $this->number;
    }

    /**
     * Check if the game is over.
     *
     * @return boolean as game state.
     */
    
    public function gameOver()
    {
        return $this->gameOver;
    }
    
    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     * 
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    
    public function makeGuess(int $number)
    { 
        if (!$this->gameOver()) {
            if ($number < 1 || $number > 100) {
                throw new GuessException("Number must be between 1 and 100");
            }

            $this->tries -= 1;
        
            if ($number == $this->number) {
                $this->gameOver = true;
                return "Congrats! {$number} is correct!";
            } else if ($this->tries < 1) {
                $this->gameOver = true;
                return "You lost. The correct answer was {$this->number}";
            } else if ($number < $this->number) {
                return "Your guess {$number} is too low";
            } else if ($number > $this->number) {
                return "Your guess {$number} is too high";
            }
        }
    }
}
