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
 */

abstract class Signature {
  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract public function __construct();
  
  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract protected function allFileSize();

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract public function getSize(int $val);
  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract public function getLink(int $val);

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract protected function moveTo(int $moveTo);

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract protected function getExtension(string $extension);

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract protected function getMimeType();

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract protected function getOriginalFileSize();

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract protected function getFileName();

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract protected function saveAs();

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract public function do_upload(string $directory = 'uploads/');

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract public function check_files(string $files);

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract public function file_count();

  /**
   * Please you keep the signature that appears as it is.
   * Never ever modify anything contained in this file.
   */
  abstract public function create_dir(string $directory);
}
?>