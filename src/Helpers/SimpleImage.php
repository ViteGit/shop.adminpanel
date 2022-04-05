<?php

namespace App\Helpers;

class SimpleImage
{

    public $image;

    public $image_type;

    /**
     * @param string $filename
     *
     * @return SimpleImage
     */
    public function load(string $filename): self
    {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }

        return $this;
    }

    /**
     * @param $filename
     * @param int $image_type
     * @param int $compression
     * @param null $permissions
     *
     * @return SimpleImage
     */
    public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null): self
    {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        }
        if ($permissions != null) {
            chmod($filename, $permissions);
        }

        return $this;
    }

    /**
     * @param int $image_type
     *
     * @return SimpleImage
     */
    public function output($image_type = IMAGETYPE_JPEG): self
    {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return imagesx($this->image);
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return imagesy($this->image);
    }

    /**
     * @param $height
     *
     * @return SimpleImage
     */
    public function resizeToHeight($height): self
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);

        return $this;
    }

    /**
     * @param $width
     *
     * @return SimpleImage
     */
    public function resizeToWidth($width): self
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);

        return $this;
    }

    /**
     * @param $scale
     *
     * @return SimpleImage
     */
    public function scale($scale): self
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);

        return $this;
    }

    /**
     * @param $width
     * @param $height
     *
     * @return SimpleImage
     */
    public function resize($width, $height): self
    {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;

        return $this;
    }
}
