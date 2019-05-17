<?php
/**
 * Twitter-SnowFlake生成唯一ID类
 * User: Dreamma
 * Date: 2019/5/14
 * Time: 13:24
 */

namespace App\Library;

use App\Exceptions\ApiHandler as Exception;

class SnowFlake
{
    //开始时间,固定一个小于当前时间的毫秒数即可(2019-05-14 13:30:00)
    const TWEPOCH = 1557812649239;

    //机器标识占的位数
    const WORDERIDBITS = 10;

    //毫秒内自增数点的位数
    const SEQUENCEBITS = 12;

    // 当前工作机器标识
    protected $workId = null;

    // 最大机器标识位数
    protected $maxWorkerId = -1 ^ (-1 << self::WORDERIDBITS);

    // 要用静态变量(必须静态)
    static $lastTimestamp = -1;
    static $sequence = 0;

    /**
     * SnowFlake constructor.
     * @param $workId
     * @throws Exception
     */
    function __construct($workId){
        //机器ID范围判断
        if($workId > $this->maxWorkerId || $workId< 0){
            throw new Exception("机器标识位数不能大于 ".$this->maxWorkerId." 或者小于 0");
        }
        //赋值
        $this->workId = $workId;
    }

    /**
     * 生成一个ID
     * @return int
     * @throws Exception
     */
    public function createId(){
        $timestamp = $this->getUnixTimestamp();
        $lastTimestamp = self::$lastTimestamp;
        //判断时钟是否正常
        if ($timestamp < $lastTimestamp) {
            throw new Exception("Clock moved backwards.  Refusing to generate id for %d milliseconds", ($lastTimestamp - $timestamp));
        }
        //生成唯一序列
        if ($lastTimestamp == $timestamp) {
            $sequenceMask = -1 ^ (-1 << self::SEQUENCEBITS);
            self::$sequence = (self::$sequence + 1) & $sequenceMask;
            if (self::$sequence == 0) {
                $timestamp = $this->tilNextMillis($lastTimestamp);
            }
        } else {
            self::$sequence = 0;
        }
        self::$lastTimestamp = $timestamp;
        //
        //时间毫秒/数据中心ID/机器ID,要左移的位数
        $timestampLeftShift = self::SEQUENCEBITS + self::WORDERIDBITS;
        $workerIdShift = self::SEQUENCEBITS;
        //组合3段数据返回: 时间戳.工作机器.序列
        $nextId = (($timestamp - self::TWEPOCH) << $timestampLeftShift) | ($this->workId << $workerIdShift) | self::$sequence;
        return $nextId;
    }

    /**
     * 取当前时间毫秒
     * @return float
     */
    protected function getUnixTimestamp(){
        $timestramp = (float)sprintf("%.0f", microtime(true) * 1000);
        return  $timestramp;
    }

    /**
     * 取下一毫秒
     * @param  $lastTimestamp
     * @return float
     */
    protected function tilNextMillis($lastTimestamp) {
        $timestamp = $this->getUnixTimestamp();
        while ($timestamp <= $lastTimestamp) {
            $timestamp = $this->getUnixTimestamp();
        }
        return $timestamp;
    }
}