<?php

declare(strict_types=1);
/**
 * 自定义验证规则
 *
 * @author yuanjw<957089263@qq.com>
 */
namespace App\Listener;


use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Hyperf\Validation\Event\ValidatorFactoryResolved;

class ValidatorFactoryResolvedListener implements ListenerInterface
{

    public function listen(): array
    {
        return [
            ValidatorFactoryResolved::class,
        ];
    }

    public function process(object $event)
    {
        /**  @var ValidatorFactoryInterface $validatorFactory */
        $validatorFactory = $event->validatorFactory;
        // 注册中国大陆手机号验证器
        $validatorFactory->extend('cn_phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[1][123456789][0-9]{9}$/', (string)$value) ? true : false;
        });
        // 注册中国大陆身份证验证器
        $validatorFactory->extend('cn_id_card', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/', (string)$value) ? true : false;
        });
        // 价格验证
        $validatorFactory->extend('price', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\d+(\.\d{1,2})?$/', (string)$value) ? true : false;
        });
    }
}
