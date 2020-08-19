Statistic
-----

**Mean** - The average value  
**Median** - The mid point value  
**Mode** - The most common value  
**Standard deviation**  
**Percentiles**

##### Standard Deviation

Standard deviation is a number that describes how spread out the values are.
A low standard deviation means that most of the numbers are close to the mean (average) value.
A high standard deviation means that the values are spread out over a wider range.
Example: This time we have registered the speed of 7 cars:

```text
speed = [86,87,88,86,87,85,86]
```
The standard deviation is:

0.9

##### Percentiles

Percentiles are used in statistics to give you a number that
describes the value that a given percent of the values are lower than.

```text
ages = [5,31,43,48,50,41,7,11,15,39,80,82,32,2,8,6,25,36,27,61,31]
```
What is the **75**. percentile? The answer is **43**, meaning that **75%** of the people are **43** or younger.

##### Usage

```php
<?php

$array = [5, 31, 43, 48, 50, 41, 7, 11, 15, 39, 80, 82, 32, 2, 8, 6, 25, 36, 27, 61, 31];

$stat = new Statistic($array);

printf("Mean: %f \n", $stat->mean());
printf("Mode: %f \n", $stat->mode());
printf("Median: %f \n", $stat->median());
printf("Percentile: %f \n", $stat->percentile(40));
printf("Deviation: %f \n", $stat->std());
```
