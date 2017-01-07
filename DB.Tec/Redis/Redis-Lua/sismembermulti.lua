--
-- Created by PhpStorm.
-- User: Wu Lihua <maikekechn@gmail.com>
-- Time: 2017/1/7 下午2:40
--
for i=1,#KEYS do
    if redis.call("SISMEMBER", KEYS[1], ARGV[1]) == 1 then
        return 1
    end
end
return 0