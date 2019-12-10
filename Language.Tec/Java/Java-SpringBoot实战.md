#### Spring Boot实战

##### 0X01 Spring Boot

1. Spring Boot精要:
   * 自动配置: 针对很多Spring应用程序常见的应用功能,Spring Boot能自动提供相关配置.
   * 起步依赖: 告诉Spring Boot需要什么功能,它就能引入需要的库.
   * 命令行界面: 这是Spring Boot的可选特性.
   * Actuator:让你能够深入运行中的Spring Boot应用程序,一探究竟.
2. 指定基于功能的依赖
   * 起步依赖: 本质上是一个Maven项目对象模型(Project Object Model, POM),定义了对其他库的传递依赖.
   * Maven获取依赖树: mvn dependency:tree
3. 使用自动配置
   * Spring Boot的自动配置是一个运行时的过程,考虑了众多因素,才决定Spring的配置应该用哪个,不该用哪个.
   * 每当应用程序启动的时候,Spring Boot的自动配置都要做将近200个这样的决定,涵盖安全,继承,持久化,Web开发等诸多方面.

##### 0X02 运用Spring Boot

1. 查看初始化的Spring Boot新项目:
   * ReadingListApplication.java:应用程序的启动引导类(bootstrap class),也是主要的Spring配置类.
   * application.properties: 用于配置应用程序和Spring Boot的属性.
   * 启动引导Spring:
     * ReadingListApplication在Spring Boot应用程序里有两个作用: 配置和启动引导.
     * @SpringBootApplication开启了Spring的组件扫描和Spring Boot的自动配置功能.其实是将三个有用的注解组合在了一起.
       * Spring的@Configuration: 标明该类使用Spring基于Java的配置.
       * Spring的@ComponentScan:启用组件扫描,这样你写的Web控制器类和其他组件才能被自动发现并注册为Spring应用程序上下文里的Bean.
       * Spring Boot的@EnableAutoConfiguration:开启Spring Boot自动配置.

##### 0X03 自定义配置

1. Spring Boot应用程序有多种设置途径.Spring Boot能从多种属性源获得属性,包括如下几处.
   - 命令行参数
   - java:comp/env里的JNDI属性
   - JVM系统属性
   - 操作系统环境变量
   - 随机生成的带random.*前缀的属性
   - 应用程序以外的Application.properties或者Application.yml文件
   - 打包在应用程序内的Application.properties或者Application.yml文件
   - 通过@PropertySource标注的属性源
   - 默认属性
   - 注: 这个列表按照优先级排序,任何在高优先级属性源里设置的属性都会覆盖低优先级的相同属性.
2. Application.properties和Application.yml文件能放在以下四个位置.
   - 外置,在相对于应用程序运行目录的/config子目录里.
   - 外置,在应用程序运行的目录里.
   - 内置,在config包内.
   - 内置,在ClassPath根目录.
   - 注:这个列表是按照优先级排序.如果你在同一优先级位置同时有Application.properties和Application.yml,那么Application.yml里的属性会覆盖Application.properties里的属性.
3. 开启配置属性:
   - @ConfigurationProperties注解不会生效,除非先向Spring配置类添加@EnableConfigurationProperties注解.但通常无需这么做,因为Spring Boot自动加上了@EnableConfigurationProperties注解.
   - Spring Boot的属性解析器非常智能,它会自动把驼峰规则的属性和使用连字符或下划线的同名属性关联起来.
4. 使用Profile进行配置:
   - 使用特定于Profile的属性文件:
     - 可以创建额外的属性文件,遵循application-{profile}.properties这种命名格式,这样就能提供特定于Profile的属性了.
     - 将与Profile无关的属性继续放在application.properties里.
5. 覆盖自动配置其实很简单,就是显示地编写那些没有Spring Boot时你要做的Spring配置.Spring Boot的自动配置被设计为优先使用应用程序提供的配置,然后才轮到自己的自动配置.

##### 0X04 测试

1. 让Spring Boot在随机选择端口上启动服务器很方便.一种方法是将server.port属性设置为0,让Spring Boot选择一个随机的可用端口.
2. @WebIntegrationTest还提供了一个randomPort属性,更明确地表示让服务器在随机端口上启动.可以将randomPort设置为true,启用随机端口.@WebIntegrationTest(randomPort=true).

##### 0X05 深入Actuator

1. Spring Boot Actuator的关键特性是在应用程序里提供众多Web端点,通过它们了解应用程序运行时的内部状况.
2. 要启用Actuator的端点,只需在项目中引入Actuator的起步依赖即可.
3. 无论Actuator是如何添加的,在应用程序运行时自动配置都会生效.Actuator会开启.
4. 查看配置明细:
   - 获得Bean装配报告:
     - 要了解应用程序中Spring上下文的情况,最重要的端点就是/beans.它会返回一个JSON文档,描述上下文里每个Bean的情况.包括其Java类型以及注入的其他Bean.
     - 所有Bean条码都有五类信息:
       - bean: Spring应用程序上下文中的Bean名称或ID.
       - resource: .class文件的物理位置,通常是一个URL,指向构建出的JAR文件.
       - dependencies:当前Bean注入的Bean ID列表.
       - scope: Bean的作用域(通常是单例.这也是默认作用域).
       - type:Bean的Java类型.
   - 详解自动配置:
     - /autoconfig端点能告诉你为什么会有这个Bean,或者为什么没有这个Bean.
   - 查看配置属性:
     - /env端点会生成应用程序可用的所有环境属性的列表.物流这些属性是否会用到.这其中包括环境变量,JVM属性,命令行参数,以及application.Properties文件提供的属性.
   - 生成端点到控制器的映射:
     - /mappings端点可以提供应用程序发布的全部端点.
     - 每个映射的值都有两个属性:bean和method.bean属性标识了SpringBean的名字,映射源自这个Bean.
     - method属性是映射对应方法的全限定方法签名.
5. 运行时度量:
   - 查看应用程度的度量值:
     - 运行中的应用程序有诸多计数器和度量器,/metrics端点提供了这些东西的快照.
   - 追踪Web请求:
     - /trace端点能报告所有Web请求的详细信息,包括请求方法,路径,时间戳以及请求和响应的头信息.
     - /trace端点实际能显示最近100个请求的信息,包含对.trace自己的请求.它在内存里维护了一个跟踪库.
   - 导出线程活动:
     - /dump端点会生成当前线程活动的快照.
     - 完成的线程导出报告里会包含应用程序的每个线程.
   - 监控应用程序健康情况:
     - 想知道自己的应用程序是否在运行,可以直接访问/health端点.
     - status属性显示了应用程序在运行中.
     - /health端点输出的某些信息可能涉及内容,因此对未经授权的请求只能提供简单的健康状态.
   - 关闭应用程序:
     - 为了关闭应用程序,需要往/shutdown端点发送一个POST请求.
     - 这个端点默认是关闭的.
     - 要开启这个端点,可以将endpoint.shutdown.enable设置为true.
   - 获取应用信息:
     - /info端点能展示各种你希望发布的应用信息.
     - 可以通过配置带有info前缀的属性向/info端点的响应添加内容.如: info.contractEmail=support@myReadingList.com

##### 附录A

1. 自动重启:

   - ```
     <dependency>
       <groupId>org.springframework.boot</groupId>
       <artifactId>spring-boot-devtools</artifactId>
     </dependency>
     ```

   - 检测到变更时,只有重启类加载器重启.