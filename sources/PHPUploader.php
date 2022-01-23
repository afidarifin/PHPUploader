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

namespace sources\PHPUploader;

/**
 * PHPUploader - Handler for Multiple Upload File
 * 
 * Welcome to the PHP Uploader Library by Afid Arifin.
 * This library contains various functions that may be useful in
 * handling your file upload process. Happy using.
 * 
 */

class PHPUploader extends Signature {
  /**
   * The $getSize property is useful for getting
   * the info obtained from the global variable $_FILES[].
   * This property will return the value as an array. 
   * @var mixed $getSize
   */
  private $getSize;

  /**
   * The $totalSize property is used
   * to capture the contents of an associative array.
   * This property will return an integer
   * value of the original file size.
   * @var mixed $totalSize
   */
  private $totalSize;

  /**
   * The getSize() method is used to get
   * the original size information of the uploaded file.
   * @param int $val
   * @return mixed
   */
  public function getSize(int $val)
  {
    /**
     * The process of checking the size information
     * of the file obtained from the global variable $_FILES[].
     */
    $this->getSize = $this->check_files($this->files);
    if($this->file_count() > 0) {
      for($x = 0; $x < $this->file_count(); $x++) {
        if(!empty($this->getSize['size'][$x])) {
          if(is_array($this->getSize['size'])) {
            $this->totalSize[] = $this->getSize['size'][$val];
          }
        }
      }
      return $this->totalSize[$val];
    }
  }

  /**
   * The $get_link property serves to hold the file link
   * that was successfully generated by the do_upload() method.
   * This property will return the value of the associative array.
   * @var mixed $get_link
   */
  private $get_link;

  /**
   * The getLink() method is used to get the link that
   * was successfully generated by the do_upload() method.
   * @param int $val
   * @return mixed
   */
  public function getLink(int $val)
  {
    /**
     * The process of checking the links obtained
     * or to be accommodated in this method.
     */
    $this->get_link = $this->link;
    return $this->get_link[$val];
  }

  /**
   * The $moveTo property is used to store
   * the unique id number for each file that is retrieved.
   * @var mixed $moveTo
   */
  private $moveTo;

  /**
   * The moveTo() method is used to move files from the temporary folder
   * to the destination folder specified in the do_upload() method.
   * @param int $moveTo
   * @return bool
   */
  protected function moveTo(int $moveTo)
  {
    /**
     * The process of checking the file transfer to be carried out.
     * This process will return a boolean value.
     */
    $this->moveTo = $this->check_files($this->files);
    return move_uploaded_file($this->moveTo['tmp_name'][$moveTo], $this->dir.'/'.$this->getFileName()[$moveTo]);
  }

  /**
   * The $is_upload property is useful for getting
   * the info obtained from the global variable $_FILES[].
   * This property will return the value as an array.
   * @var mixed $is_upload
   */
  private $is_upload;

  /**
   * The $move property acts as a placeholder for
   * the value returned by the moveTo() method.
   * This property will return a boolean value.
   * @var mixed $move
   */
  private $move;
  
  /**
   * The $dir property acts as a container for
   * the directory specified in the do_upload() method.
   * @var mixed $dir
   */
  private $dir;

  /**
   * The $rename property is used to capture whether the do_upload() method
   * will generate a random filename or not. This property can only be filled
   * with boolean values and by default it is set to true
   * which means it will generate random file names.
   * @var mixed $rename
   */
  private $rename;

  /**
   * The $renamed property is used to store filenames
   * that have been changed randomly. This property will
   * return a boolean value obtained from the built-in rename() function.
   * @var mixed $renamed
   */
  private $renamed;

  /**
   * The $new_file property serves as a placeholder
   * for randomly generated file names.
   * @var mixed $new_file
   */
  private $new_file;

  /**
   * The $link property is used to accommodate files that
   * have been uploaded successfully. This property will return a value
   * in the form of an array which will be further processed.
   * @var mixed $link
   */
  private $link;

  /**
   * The do_upload() method is the core of this library.
   * This method functions as a handler for multiple uploads.
   * This method will return the value as an array.
   * @param string $directory
   * @param bool $rename
   * @return mixed
   */
  public function do_upload(string $directory = 'uploads/', bool $rename = true)
  {
    /**
     * The following three properties are the main properties
     * and be sure to stay in place at all times.
     * Never delete or change the following properties.
     */
    $this->rename     = $rename;
    $this->dir        = $directory;
    $this->is_upload  = $this->check_files($this->files);

    // Counting the number of files.
    if($this->file_count() > 0)
    {
      for($x = 0; $x < $this->file_count(); $x++)
      {
        if(!empty($this->is_upload['name'][$x]))
        {
          if(is_array($this->is_upload['name']))
          {
            // Move every incoming file from array
            $this->move = $this->moveTo($x);
            
            if($this->move)
            {
              if($this->rename)
              {
                /**
                 * If the rename status is true then a random new file name will be generated.
                 */
                $this->new_file = $this->dir.$this->saveAs().'.'.$this->getExtension($this->getFileName()[$x]);
                $this->renamed  = rename($this->dir.$this->getFileName()[$x], $this->new_file);

                if($this->renamed)
                {
                  /**
                   * Collect the results of generating a new file name
                   * into the $this->link property which is an array.
                   */
                  $this->link[] = $this->new_file;
                }
              } else {
                /**
                 * If the rename status is false, the file name
                 * will be returned to the original name of the file.
                 * Put the original filenames into the $this->link
                 * property which is an array.
                 */
                $this->link[]   = $this->dir.$this->getFileName()[$x];
              }
            }
          }
        } else {

          // Returns the process value as an boolean false if empty file.
          return false;
        }
      }
      
      // Returns the process value as an array.
      return $this->link;
    }
  }

  /**
   * The property serves to detect whether the server
   * supports the file upload feature or not.
   * @var string|false $file_uploads
   */
  private $file_uploads;

  /**
   * The method that is automatically executed
   * the first time the library is called.
   * @return void
   */
  public function __construct()
  {
    /**
     * The process of checking file upload support on the server.
     */
    $this->file_uploads = ini_get('file_uploads');

    /**
     * Show warning if not supported.
     */
    if(!$this->file_uploads) {
      echo '<b>Error!</b> Looks like your file_uploads system is down. Please activate it in the php.ini file.';
      exit();
    }
  }

  /**
   * This property serves to hold
   * the value of the global variable $_FILES[].
   * @var mixed $allFileSize
   */
  private $allFileSize;

  /**
   * This property serves to hold
   * all values of the existing file size.
   * @var mixed $total_size
   */
  private $total_size;

  /**
   * This method serves to add up all existing file sizes.
   * @return mixed
   */
  protected function allFileSize()
  {
    $this->allFileSize = $this->check_files($this->files);
    if($this->file_count() > 0)
    {
      for($x = 0; $x < $this->file_count(); $x++)
      {
        if(!empty($this->allFileSize['size'][$x]))
        {
          if(is_array($this->allFileSize['size']))
          {
            $this->total_size += $this->allFileSize['size'][$x];
          }
        }
      }

      /**
       * Returns the process value as an integer.
       */
      return $this->total_size;
    }
  }

  /**
   * This property is used to get the mime value
   * or file type of each captured file of the $_FILES[].
   * @var mixed $mimeType
   */
  private $mimeType;

  /**
   * This method is used to get file type information.
   * @return mixed
   */
  protected function getMimeType()
  {
    $this->mimeType = $this->check_files($this->files);
    if($this->file_count() > 0)
    {
      for($x = 0; $x < $this->file_count(); $x++)
      {
        if(!empty($this->mimeType['type'][$x]))
        {
          if(is_array($this->mimeType['type']))
          {
            /**
             * Returns the process value as an string.
             */
            return $this->mimeType['type'];
          }
        }
      }
    }
  }

  /**
   * This property serves to hold
   * the original value of the captured file size of the $_FILES[].
   * @var mixed $originalFileSize
   */
  private $originalFileSize;

  /**
   * This method is used to get information
   * on the original size of the uploaded file.
   * @return array
   */
  protected function getOriginalFileSize(): array
  {
    $this->originalFileSize = $this->check_files($this->files);
    if($this->file_count() > 0)
    {
      for($x = 0; $x < $this->file_count(); $x++)
      {
        if(!empty($this->originalFileSize['size'][$x]))
        {
          if(is_array($this->originalFileSize['size']))
          {
            /**
             * Returns the process value as an array.
             */
            return $this->originalFileSize['size'];
          }
        }
      }
    }
  }

  /**
   * This property is used to hold
   * the filename obtained of the $_FILES[].
   * @var mixed $file
   */
  private $file;

  /**
   * This method serves to get the name of the uploaded file.
   * @return array
   */
  protected function getFileName(): array
  {
    $this->file = $this->check_files($this->files);
    if($this->file_count() > 0)
    {
      for($x = 0; $x < $this->file_count(); $x++)
      {
        if(!empty($this->file['name'][$x]))
        {
          if(is_array($this->file['name']))
          {
            /**
             * Returns the process value as an array.
             */
            return $this->file['name'];
          }
        }
      }
    }
  }

  /**
   * This property serves to accommodate the character to be scrambled.
   * @var mixed $alias
   */
  private $alias;

  /**
   * This property is used to hold characters that have been scrambled.
   * @var mixed $rand
   */
  private $rand;

  /**
   * This property serves to accommodate the results of characters that have been randomized.
   * @var mixed $result
   */
  private $result;

  /**
   * This method serves to generate random
   * characters that will be processed in the do_upload() method.
   * @return string|false
   */
  protected function saveAs()
  {
    $this->alias    = 'abcdefghijklmnopqrstyvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $this->rand     = str_shuffle($this->alias);
    $this->result   = substr(($this->rand), 0, 15);

    /**
     * Returns the process value as an string.
     */
    return $this->result;
  }

  /**
   * This property serves to hold the captured file extension.
   * @var mixed $extension
   */
  private $extension;

  /**
   * This method is used to capture file extension information.
   * @param string $extension
   * @return string[]|false
   */
  protected function getExtension(string $extension)
  {
    $this->extension = $extension;

    /**
     * Returns the process value as an string.
     */
    return pathinfo($this->extension, PATHINFO_EXTENSION);
  }

  /**
   * This property is used to hold the captured value.
   * @var mixed $files
   */
  private $files;

  /**
   * This method is used to get the file information captured by $_FILES[].
   * @param string $files
   * @return mixed
   */
  public function check_files(string $files)
  {
    $this->files = $files;

    /**
     * Returns the process value as an array.
     */
    return $_FILES[$this->files];
  }
  
  /**
   * This property is used to hold the calculated number of files.
   * @var mixed $count
   */
  private $count;

  /**
   * This method is used to generate the calculated number of files.
   * @return int
   */
  public function file_count()
  {
    $this->count = $this->check_files($this->files);

    /**
     * Returns the process value as an integer.
     */
    return count($this->count['name']);
  }

  /**
   * This property is used to capture file directories.
   * @var mixed $directory
   */
  private $directory;

  /**
   * This method functions to create directories automatically based on user input.
   * @param string $directory
   * @return bool|void
   */
  public function create_dir(string $directory)
  {
    $this->directory = $directory;
    if(!is_dir($this->directory))
    {
      if(mkdir($this->directory))
      {
        return true;
      } else {
        return false;
      }
    }
  }
}
?>