<?php
/**
 * @package		OpenCart
 * @author		Daniel Kerr
 * @copyright	Copyright (c) 2005 - 2017, OpenCart, Ltd. (https://www.opencart.com/)
 * @license		https://opensource.org/licenses/GPL-3.0
 * @link		https://www.opencart.com
*/

/**
* Log class
*/
class Log {
	private $handle;
	
	/**
	 * Constructor
	 *
	 * @param	string	$filename
 	*/
	public function __construct($filename) {
		$filePath = DIR_LOGS . $filename;
		if (!file_exists($filePath)) {
			$this->createDirectory($filePath);
		}
		$this->handle = fopen(DIR_LOGS . $filename, 'a');
	}

	/**
     *
     *
     * @param	string	$message
     */
	public function write($message) {
		fwrite($this->handle, date('Y-m-d G:i:s') . ' - ' . print_r($message, true) . "\n");
	}

	/**
     *
     *
     */
	public function __destruct() {
		fclose($this->handle);
	}

    public function writeException($e)
    {
        if (!is_object($e)) {
            throw new Exception('Invalid exception object!');
        }
        $this->write('PHP Exception: ' . $e->getCode() . ', ' . $e->getMessage());
        $this->write($e->getFile() . "(line:{$e->getLine()})");
    }

    private function createDirectory($filePath)
    {
        $directory = dirname($filePath);
        return is_dir($directory) or $this->createDirectory(dirname($directory)) and mkdir($directory, 0777);
    }
}
