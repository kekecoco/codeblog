--
-- Created by PhpStorm.
-- User: Wu Lihua <maikekechn@gmail.com>
-- Time: 2017/1/7 下午2:19
--
--[[
--限速返回1 否则返回0
--]]
local frequency = redis.call("INCR", KEYS[1])
if frequency > tonumber(ARGV[1])
    then
        return 1
end
if frequency == 1
    then
        redis.call("PEXPIRE", KEYS[1], ARGV[2])
end
return 0