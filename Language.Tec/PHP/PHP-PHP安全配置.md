# PHP安全配置  
### 相关参数说明  
1. disable_functions = ：*这一项对服务器的安全非常重要。一般禁用的函数有：*    
```  
disable_functions = virtual,phpinfo,passthru,system,chroot,shell_exec,proc_open,proc_get_status,show_source,proc_terminate,proc_nice,proc_close,parse_ini_file,listen,link,highlight_file,getmyuid,getmypid,fsocket_open,fpaththru,diskfreespace,dl,posix,posix_ctermid,posix_getcwd,posix_getegid,posix_geteuid,posix_getgid,posix_getgrgid,posix_getgrnam,posix_getgroups,posix_getlogin,posix_getpgid,posix_getpgrp,posix_getpid,posix_getpwnam,posix_getpwuid,posix_getrlimit,posix_getsid,posix_getuid,posix_isatty,posix_kill,posix_mkfifo,posix_setegid,posix_seteuid,posix_setgid,posix_setpgid,posix_setsid,posix_setuid,posix_times,posix_ttyname,posix_uname```
2. display_errors: 如果为on的话改为off
3. display_startup_errors：0  
```