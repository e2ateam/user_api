<?php

/**
 * phpunit-threshold.php
 * check if the coverage of phpunit is above specified threshold
 * https://cylab.be/blog/114/fail-a-phpunit-test-if-coverage-goes-below-a-threshold
 */
if ($argc != 3) {
    echo 'Usage: '.$argv[0].' <path/to/index.xml> <threshold>
';
    exit(-1);
}

$file = $argv[1];
$threshold = (float) $argv[2];

$coverage = simplexml_load_file($file);
$ratio = (float) $coverage->project->directory->totals->lines['percent'];

echo "Line coverage: $ratio%
";
echo "Threshold: $threshold%
";

if ($ratio < $threshold) {
    echo 'FAILED!
';
    exit(-1);
}

echo 'SUCCESS!
';
