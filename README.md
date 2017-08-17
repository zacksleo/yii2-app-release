yii2 app-release module

[![Latest Stable Version](https://poser.pugx.org/zacksleo/yii2-app-release/version)](https://packagist.org/packages/zacksleo/yii2-app-release)
[![Total Downloads](https://poser.pugx.org/zacksleo/yii2-app-release/downloads)](https://packagist.org/packages/zacksleo/yii2-app-release)
[![License](https://poser.pugx.org/zacksleo/yii2-app-release/license)](https://packagist.org/packages/zacksleo/yii2-app-release)
[![StyleCI](https://styleci.io/repos/93126638/shield)](https://styleci.io/repos/93126638)
[![Build Status](https://travis-ci.org/Graychen/yii2-app-release.svg?branch=master)](https://travis-ci.org/Graychen/yii2-app-release)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Graychen/yii2-app-release/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-app-release/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Graychen/yii2-app-release/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-app-release/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Graychen/yii2-app-release/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-app-release/build-status/master)


# Usage

## Config Migration Path or Migration By migrationPath Parameter

### Config Migration Path  in Yii config file like this

```
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@console/migrations/',
                '@zacksleo/yii2/apprelease/migrations',
            ],
        ],
    ],

```

### Run migration by By migrationPath Parameter

```
  ./yii migrate --migrationPath=@zacksleo/yii2/apprelease/migrations

```

## Config Module in components part

```
    'app-release' => [
        'class' => 'zacksleo\yii2\apprelease\Module',
    ]

```


