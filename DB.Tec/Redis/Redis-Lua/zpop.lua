--
-- Created by PhpStorm.
-- User: Wu Lihua <maikekechn@gmail.com>
-- Time: 2017/1/7 下午3:03
--
local result = redis.call("ZRANGE", KEYS[1], -1, -1, "WITHSCORES")
if result then redis.call("ZREMRANGEBYRANK", KEYS[1], -1, -1) end
return result