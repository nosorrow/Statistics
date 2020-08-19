<?php


class Statistic
{
    private $data = [];

    /**
     * Statistic constructor.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Mean - The average value
     * ------------------------
     * @return float
     */
    public function mean(): float
    {
        return array_sum($this->data) / count($this->data);
    }

    /**
     * Median - The mid point value
     * -----------------------------
     * The median value is the value in the middle, after you have sorted all the values:
     *
     * 77, 78, 85, 86, 86, 86, (87), 87, 88, 94, 99, 103, 111
     *
     * It is important that the numbers are sorted before you can find the median.
     *
     * If there are two numbers in the middle, divide the sum of those numbers by two.
     * 77, 78, 85, 86, 86, 86, 87, 87, 94, 98, 99, 103
     * (86 + 87) / 2 = 86.5
     *
     * @return float
     */
    public function median(): float
    {
        $data = $this->data;
        sort($data);
        $n = count($data);
        if ($n % 2 === 0) {
            return ($data[$n / 2] + $data[$n / 2 - 1]) / 2;
        }

        return $data[$n / 2];
    }

    /**
     * Mode - The most common value
     * -----------------------------
     * The Mode value is the value that appears the most number of times:
     * 99, 86, 87, 88, 111, 86, 103, 87, 94, 78, 77, 85, 86 = {86}
     *
     * @return float
     */
    public function mode(): float
    {
        $count_values = (array_count_values($this->data));

        return current(array_keys($count_values, max($count_values)));
    }

    /**
     * Percentile
     * ----------
     * Percentiles are used in statistics to give you a number that describes the value
     * that a given percent of the values are lower than.
     * Example: Let's say we have an array of the ages of all the people that lives in a street.
     * ages = [5,31,43,48,50,41,7,11,15,39,80,82,32,2,8,6,25,36,27,61,31]
     * What is the 75. percentile? The answer is 43, meaning that 75% of the people are 43 or younger.
     *
     * @param $percentile
     * @return float
     */
    public function percentile($percentile): float
    {
        $data = $this->data;
        if (0 < $percentile && $percentile < 1) {
            $p = $percentile;
        } elseif (1 < $percentile && $percentile <= 100) {
            $p = $percentile * .01;
        } else {
            return 0;
        }
        $count = count($data);
        $allindex = ($count - 1) * $p;
        $intvalindex = (int)$allindex;
        $floatval = $allindex - $intvalindex;
        sort($data);
        if (!is_float($floatval)) {
            $result = $data[$intvalindex];
        } else {
            if ($count > $intvalindex + 1) {
                $result = $floatval * ($data[$intvalindex + 1] - $data[$intvalindex]) + $data[$intvalindex];
            } else {
                $result = $data[$intvalindex];
            }
        }

        return $result;
    }

    /**
     * Standard deviation - std
     * -------------------
     * Standard deviation is a number that describes how spread out the values are.
     * A low standard deviation means that most of the numbers are close to the mean (average) value.
     * A high standard deviation means that the values are spread out over a wider range.
     * Example: This time we have registered the speed of 7 cars:
     * speed = [86,87,88,86,87,85,86]
     * The standard deviation is: 0.9
     *
     * Indicates if {data} represents a sample of the population; defaults to FALSE.
     *
     * @param bool $sample
     * @return bool|float
     * @throws Exception
     */
    public function std($sample = false)
    {
        $a = $this->data;
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double)$val) - $mean;
            $carry += $d * $d;
        }
        if ($sample) {
            --$n;
        }

        return sqrt($carry / $n);
    }
}

$array = [5, 31, 43, 48, 50, 41, 7, 11, 15, 39, 80, 82, 32, 2, 8, 6, 25, 36, 27, 61, 31];

$stat = new Statistic($array);

printf("Mean: %f \n", $stat->mean());
printf("Mode: %f \n", $stat->mode());
printf("Median: %f \n", $stat->median());
printf("Percentile: %f \n", $stat->percentile(40));
printf("Deviation: %f \n", $stat->std());
