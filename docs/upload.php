<?php
/**
 * PHPUploader by Afid Arifin
 * PHP Version >= 7
 * 
 * @see https://www.afidbara.com
 * 
 * @package     PHPUploader by Afid Arifin
 * @version     v1.0
 * @author      Afid Arifin
 * @copyright   2022
 * @license     http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * 
 * @note        This program is distributed in the hope that it will be useful - WITHOUT
 *              ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 *              FITNESS FOR A PARTICULAR PURPOSE.
 */

use sources\Signature;
use sources\PHPUploader\PHPUploader;

/**
 * PHPUploader - Handler for Multiple Upload File
 */

/**
 * Make sure you always position the main file of the resource from
 * the library always as below. If you place the extraction
 * library somewhere else then you adjust it yourself.
 */
require_once '../sources/Signature.php';
require_once '../sources/PHPUploader.php';

/**
 * The object name $upload is an object instance of this library.
 * You are free to name the object for example $file
 * or something else or you can ignore this default object name.
 */
$upload = new PHPUploader();

/**
 * The process of getting the file that was successfully inputted.
 */
if(isset($_POST['submit']))
{
  /**
   * This check_files() method has one parameter where this method
   * must be filled with a value in the form of a string data type from your html attribute name.
   * This method will return a value in the form of an array which will be
   * further processed in the core library. Below is an example of using
   * the check_files(string $files) method and this method should always be on the first line of checking.
   */
  $files = $upload->check_files('files');

  /**
   * This section is to check whether the directory has been created or not.
   * If not, it will be created automatically by the create_dir() method.
   */
  if(!is_dir('uploads'))
  {
    /**
     * This method has one parameter where this method must be filled with
     * a value in the form of a string data type and will return a boolean value.
     */
    $upload->create_dir('uploads');
  }

  /**
   * Check the files captured by the check_files() method and the file_count()
   * method will return a value of integer data type.
   */
  if($upload->file_count() > 0)
  {
    /**
     * If all processes have been validated then the process will be continued
     * by the do_upload(string $directory, bool $rename) method. This method has two parameters,
     * where the first parameter must be filled in the destination directory and the
     * second parameter is optional which is set to true (then the uploaded file name will be renamed randomly)
     * or if it is filled in false (then the file name will not be renamed). The do_upload()
     * method will return a value in the form of an array that is processed in
     * the core library or false if there is an indication that no file has been selected.
     */
    if($upload->do_upload('uploads/')) {
      echo $upload->file_count().' file(s) uploaded successfully.';
    } else {
      echo 'Please select the file to upload.';
    }
  }
}
?>