--
-- Created by PhpStorm.
-- User: Wu Lihua <maikekechn@gmail.com>
-- Time: 2017/1/7 上午11:25
--
local fields = redis.call("SMEMBERS", KEYS[2])
local values = redis.call("HMGET", KEYS[1], unpack(fields))
local results = {}
for i,k in ipairs(fields) do results[i] = {k, values[i]} end
return results