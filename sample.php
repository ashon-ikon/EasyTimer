<?php

class SmartTimer {
	
    /**
     * Coverts the time duration in seconds (integer) to string
     *
     * @param integer $duration Duration in seconds
     * @param boolean $ignoreZero True to avoid processing values lower than zero
     * @param boolean $showMilli Show Duration in milli seconds
     *
     * @return string Human readable string
     */
    public static function durationToString($duration, $ignoreZero = false, $showMilli = false)
    {
        $durationRaw    = $duration;
        $duration   = (int) $duration;
        $return     = '';

        if ($ignoreZero && $duration == 0) {
            return $return;
        }

        if ($showMilli && $durationRaw < 1 && $durationRaw != 0) {
            // Use raw timing..
            $duration   = $durationRaw * 1000;
            $return     = number_format($duration, 3) . ' millisecond' . ($duration > 1 ? 's' : '');
        } else {
            if ($duration < 60) {
                $return = $duration . ' second' . ($duration > 1 ? 's' : '');
            } elseif ($duration < (60 * 60)) {
                $raw        = intval($duration / 60);
                $remainder  = $duration % 60;
                $min    = number_format($raw, 0);
                $return = $min . ' minute' . ($min > 1 ? 's' : '') . ' '. self::timeToString($remainder, true);
            } elseif ($duration < (60 * 60 * 24)) {
                $raw        = intval($duration / (60 * 60));
                $remainder  = $duration % (60 * 60);
                $hour       = number_format($raw, 0);
                $return = $hour . ' hour' . ($hour > 1 ? 's' : '') . ' '. self::timeToString($remainder, true);
            } elseif ($duration >= (60 * 60 * 24)) {
                $raw        = intval($duration / (60 * 60 * 24));
                $remainder  = $duration % (60 * 60 * 24);
                $day        = number_format($raw, 0);
                $return = $day . ' day' . ($day > 1 ? 's' : '') . ' '. self::timeToString($remainder, true);
            }
        }
        return trim($return);
    }
}
