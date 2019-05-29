<?php

ini_set('display_errors', true);

require_once __DIR__ . '/vendor/autoload.php';

$arguments = getopt("d::", array("data::"));
$dataFolder = "/data";
if (isset($arguments["data"])) {
    $dataFolder = $arguments["data"];
}
$config = json_decode(file_get_contents($dataFolder . "/config.json"), true)["parameters"];

if (!isset($config["#X-KBC-ManageApiToken"])) {
    print "#X-KBC-ManageApiToken not set\n";
    exit(1);
}

$syrupUrl = 'https://syrup.keboola.com';
if (isset($config["syrupURL"])) {
    $syrupUrl = $config["syrupURL"];
}

$token = $config["#X-KBC-ManageApiToken"];

$command = 'curl -X "POST" "' . $syrupUrl . '/provisioning/manage/server/mysql/garbage-collection?type=sandbox&days=14" -H "X-KBC-ManageApiToken: ' . $token . '"';
$process = new \Symfony\Component\Process\Process($command);
$process->setTimeout(null);
$process->mustRun();
print $process->getOutput() . "\n";

$command = 'curl -X "POST" "' . $syrupUrl . '/provisioning/manage/server/mysql/garbage-collection?type=transformations&days=7" -H "X-KBC-ManageApiToken: ' . $token . '"';
$process = new \Symfony\Component\Process\Process($command);
$process->setTimeout(null);
$process->mustRun();
print $process->getOutput() . "\n";

$command = 'curl -X "POST" "' . $syrupUrl . '/provisioning/manage/server/docker/garbage-collection?type=rstudio&hours=120" -H "X-KBC-ManageApiToken: ' . $token . '"';
$process = new \Symfony\Component\Process\Process($command);
$process->setTimeout(null);
$process->mustRun();
print $process->getOutput() . "\n";

$command = 'curl -X "POST" "' . $syrupUrl . '/provisioning/manage/server/docker/garbage-collection?type=jupyter&hours=120" -H "X-KBC-ManageApiToken: ' . $token . '"';
$process = new \Symfony\Component\Process\Process($command);
$process->setTimeout(null);
$process->mustRun();
print $process->getOutput() . "\n";
