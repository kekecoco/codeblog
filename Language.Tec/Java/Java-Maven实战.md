#### 0X01 maven简介

1. Maven不仅是构建工具,还是一个依赖管理工具和项目信息管理工具.

#### 0X02 Maven的安装和配置

1. M2_HOME:
   - conf: 该目录包含了一个非常重要的文件settings.xml.直接修改该文件,就能在机器上全局地定制Maven的行为.一般情况下,更倾向于复制该文件至~/.m2/目录下,然后修改该文件,在用户范围内定制Maven的行为.
2. Maven安装最佳实践:
   - 设置MAVEN_OPTS环境变量.
   - 配置用户范围settings.xml:Maven用户可以选择配置$M2_HOME/conf/settings.xml或者~/.m2/settings.xml.前者是全局范围的,整台机器上的所有用户都会直接受到该配置的影响.而后者是用户范围的,只有当前用户才会受到该配置的影响.

#### 0X03 Maven使用入门

1. 编写POM:
   - Maven项目的核心是pom.xml.POM(Project Object Model,项目对象模型)定义了项目的基本信息,用于描述项目如何构建,,声明项目依赖.
   - 代码的第一行是XML头,指定了该xml文档的版本和编码方式.
   - 紧接着是project元素,project是所有pom.xml的根元素,它还声明了一些POM相关的命名空间及xsd元素.
   - 根元素下的第一个子元素modelVersion指定了当前POM模型的版本,对于Maven2及Maven3来说,只能是4.0.0
   - 最重要的是包含groupId, artifactId和version这三行.这三个元素定义了一个项目基本的坐标,任何的jar,pom或者war都是基于这些基本的坐标进行区分的.
   - groupId定义了项目属于哪个组,这个组往往和项目所在的组织或者公司存在关联.
   - artifactId定义了当前Maven项目在组中唯一的ID.
   - version指定了项目当前的版本.SNAPSHOT意为快照,说明该项目还处于开发中,是不稳定的版本.
   - name元素声明了一个对用户友好的项目名称.
2. 打包和运行:
   - POM中没有指定打包类型,使用默认的打包类型jar.
3. 使用Archtype生成项目骨架:
   - 使用maven archetype来创建项目的骨架.
   - 简单的运行: mvn archetype:generate

#### 0X04 坐标和依赖

1. Maven坐标的元素包括groupId, artifactId, version, packaging, classifier.只要我们提供正确的坐标元素,Maven就能找到对应的构件.

2. Maven内置了一个中央仓库的地址(http://repol.maven.org/maven2),该中央仓库包含了世界上大部分流行的开源项目构件.

3. 一组Maven坐标是通过一些元素定义的.它们是groupId, artifactId, version, packaging, classifier.

   - groupId: 定义当前Maven项目隶属的实际项目.groupId不应该对应项目隶属的组织或公司.上例中,groupId为org.sonatype.nexus.
   - artifactId:定义实际项目中的一个Maven项目(模块),推荐的做法是使用实际项目名称作为artifactId的前缀.比如上例中的artifactId是nexus-indexer,使用了实际项目名nexus作为前缀,这样做的好处是方便寻找实际构件.
   - version: 定义Maven项目房钱所处的版本.
   - packaging: 定义Maven项目的打包方式.Maven默认的打包方式是jar.
   - classifier: 该元素用来帮助定义构建输出的一些附属构建.注意,不能直接定义项目的classifier,因为附属构建不是项目直接默认生成的,而是由附加的插件帮助生成.
   - 上述5个元素中,groupId,artifactId,version是必须定义的,packaging是可选的,而classifier是不能直接定义的.

4. 依赖的配置:

   - 根元素project下的dependencies可以包含一个或者多个dependencies元素,以声明一个或者多个项目依赖.
     - groupId,artifactId和version: 依赖的基本坐标,对于任何一个依赖来说,基本坐标是最重要的, Maven根据坐标才能找到需要的依赖.
     - type: 依赖的类型,对应于项目坐标定义的packaging.大部分情况下,该元素不必声明,其默认值为jar.
     - scope: 依赖的范围.
     - optional: 标记依赖是否可选.
     - exclusions: 用来排除传递性依赖.

5. 依赖范围:

   - 依赖范围就是用来控制依赖与这三种classpath(编译classpath, 测试classpath, 运行classpath)的关系, Maven有以下几种依赖范围:
     - compile: 编译依赖范围.如果没有指定,就会默认使用该依赖范围.使用此依赖范围的Maven依赖,对于编译, 测试, 运行三种classpath都有效.
     - test: 测试依赖范围.使用此依赖范围的Maven依赖,只对于测试classpath有效,在编译生成代码或者运行项目的使用时将无法使用此依赖.
     - provided: 已提供依赖范围.使用此依赖范围的Maven依赖,对于编译和测试classpath有效,但在运行时无效.
     - runtime: 运行时依赖范围.使用此依赖范围的Maven依赖,对于测试和运行classpath有效,但在编译主代码时无效.
     - system: 系统依赖范围.改依赖与三种classpath的关系,和provided依赖范围完全一致.使用system范围的依赖时必须通过systemPath元素显式地指定依赖文件的路径.
     - import: 导入依赖范围.

6. 传递性依赖:

   - 有了传递性依赖机制,在使用Spring Framework的时候就不用去考虑它依赖了什么,也不用担心引入多余的依赖.Maven会解析各个直接依赖的POM,将那些必要的间接依赖,以传递性依赖的形式引入到当前的项目中.

   - 依赖性传递和依赖范围:

     - 依赖范围不仅可以控制依赖与三种classpath的关系,还对传递性依赖产生影响.

     - 假设A依赖于B, B依赖于C, 我们说A对于B是第一直接依赖,B对于C是第二直接依赖,A对于C是传递性依赖.第一直接依赖的范围和第二直接依赖的范围决定了传递性依赖的范围.

     - 依赖范围影响传递性依赖表:

       - |          | compile  | test | provided | runtime  |
         | -------- | -------- | ---- | -------- | -------- |
         | compile  | compile  | --   | --       | runtime  |
         | test     | test     | --   | --       | test     |
         | provided | provided | --   | provided | provided |
         | runtime  | runtime  | --   | --       | runtime  |

       - 当第二直接依赖的范围是compile的时候,传递性依赖的范围与第一直接依赖的范围一致;当第二直接依赖的范围是test的时候,依赖不会得以传递;当第二直接依赖的范围是provided的时候,只传递第一直接依赖范围也为provided的依赖,且传递性依赖的范围同样为provided;当第二直接依赖的范围是runtime的时候,传递性依赖的范围与第一直接依赖的范围一致,但compile例外,此时传递性依赖的范围为runtime.

   - 依赖调解:

     - 项目A有这样的依赖关系: A => B => C => X(1.0), A=> D => X(2.0), X是A 的传递性依赖,但是两条依赖路径上有两个版本的X,那么哪个X会被Maven解析使用呢?
     - Maven依赖调节器的第一原则是:路径最近者优先.该例中X(1.0)的路径长度为3,而X(2.0)的路径长度为2,因此X(2.0)会被解析使用.
     - A => B => Y(1.0), A => C => Y(2.0), Y(1.0)和Y(2.0)的依赖路径长度是一样的,都为2.
     - Maven定义了依赖调解的第二原则: 第一声明优先.在依赖路径长度相等的情况下,在POM依赖声明的顺序决定了谁会被解析使用,顺序最靠前的那个依赖优胜.

   - 可选依赖:

     - 假设有这样一个依赖关系,项目A依赖于项目B,项目B依赖于项目X和Y,B对于X和Y的依赖都是可选依赖:A => B, B => X(可选), B => Y(可选).
     - 根据传递性依赖的定义,如果所有这三个依赖的范围都是compile,那么X, Y就是A的compile范围传递性依赖.然而由于这里X, Y是可选依赖,依赖将不会得以传递.
     - 在理想的情况下,是不应该使用可选依赖的.

7. 最佳实践:

   - 排除依赖:
     - 传递性依赖会给项目隐式地引入很多依赖,但是当项目中有一个第三方依赖,而这个第三方依赖由于某些原因依赖了另外一个类库的SNAPSHOT版本,那么这个SNAPSHOT就会成为当前项目的传递性依赖,而SNAPSHOT的不稳定性会直接影响到当前的项目.
     - 代码中使用exclusion元素声明排除依赖,exclusion可以包含一个或者多个exclusion子元素,因此可以排除一个或者多个传递性依赖.
     - 声明exclusion的时候只需要groupId和artifactId, 而不需要version元素,这是因为只需要groupId和artifactId就能唯一定位依赖图中的某个依赖.
   - 归类依赖:
     - 首先使用properties元素定义Maven属性,该例中定义了一个springframework.version子元素.有了这个属性定义后,Maven运行的时候会将POM中的所有的${springframework.version}替换成实际的值.
   - 优化依赖:
     - 可以运行如下的命令查看当前项目的已解析依赖:
       - mvn dependency:list
     - 可以运行如下命令查看当前项目的依赖树:
       - mvn dependency:tree
     - 分析当前项目的依赖:
       - mvn dependency:analyze

#### 0X05 仓库

1. 仓库的布局:
   - 任何一个构件都有其唯一的坐标,根据这个坐标可以定义其在仓库中的唯一存储路径,这便是Maven的仓库布局方式.
   - 路径按如下的步骤生成:
     - 基于构件的groupId准备路径,formatAsDirectory()将groupId中的句点分隔符转换成路径分隔符.
     - 基于构件的artifactId准备路径,也就是在前面的基础上加上artifactId以及一个路径分隔符.
     - 使用版本信息.在前面的基础上加上version和路径分隔符.
     - 依次加上artifactId,构件分隔符连字号,以及version.
     - 如果构建有classifier,就加上构件分隔符和classifier.
     - 检查构件的extension,若extension存在,则加上句点分隔符和extension.
2. 仓库的分类:
   - 仓库只分为两类: 本地仓库和远程仓库.
   - 当Maven根据坐标寻找构件的时候,它首先会查看本地仓库,如果本地仓库存在此构件,则直接使用;如果本地仓库不存在此构件,或者需要查看是否有更新的构件版本,Maven就会去远程仓库查找,发现需要的构件之后,下载到本地仓库再使用.如果本地仓库和远程仓库都没有需要的构件,Maven就会报错.
   - 中央仓库是Maven核心自带的远程仓库. 私服是另一种特殊的远程仓库.除了中央仓库和私服,还有很多其他公开的远程仓库.
   - 本地仓库:
     - 默认情况下.不管是Windows还是Linux上,每个用户在自己的用户目录下都有一个路径名为.m2/repository的仓库目录.
   - 远程仓库:
     - 安装好Maven后,如果不执行任何Maven命令,本地仓库目录是不存在的.当用户输入第一条Maven命令之后,Maven才会创建本地仓库,然后根据配置和需要,从远程仓库下载构件至本地仓库.
     - 每个用户只有一个本地仓库,但可以配置访问很多远程仓库.
   - 中央仓库:
     - 中央仓库包含了这个世界上绝大多数流行的开源Java构件,以及源码,作者信息,SCM信息,许可证信息等.
   - 私服:
     - 私服是一种特殊的远程仓库,它是架设在局域网内的仓库服务,私服代理广域网上的远程仓库,供局域网内的Maven用户使用.当Maven需要下载构件的时候,它从私服请求,如果私服上不存在该构件,则从外部的远程仓库下载,缓存在私服上后,再为Maven的下载请求提供服务.
     - 架设私服的好处:
       - 节省自己的外网带宽.
       - 加速Maven构建.
       - 部署第三方构件.
       - 提高稳定性,增强控制.
       - 降低中央仓库的负荷.
   - 远程仓库的配置:
     - 在repositories元素下,可以使用repository子元素声明一个或者多个远程仓库.
     - 任何一个仓库声明的id必须是唯一的,尤其需要注意的是,Maven自带的中央仓库使用的id为central,如果其他仓库声明也使用该id,就会覆盖中央仓库的配置.
   - 远程仓库的认证:
     - Maven使用settings.xml文件中并不显而易见的servers元素及其server子元素配置仓库认证信息.settings,xml中的server元素的id必须与POM中需要认证的repository元素的id完全一致.
   - 镜像:
     - <mirrorOf>*</mirrorOf>: 匹配所有远程仓库
     - <mirrorOf>external:*</mirrorOf>:匹配所有不在本机上的远程仓库
     - <mirrorOf>repo1,repo2</mirrorOf>:匹配仓库repo1和repo2,使用逗号分隔多个远程仓库.
     - <mirrorOf>*,!repo1</mirrorOf>: 匹配所有远程仓库,repo1除外,使用感叹号将仓库从匹配中删除.
     - 注: 由于镜像仓库完全屏蔽了被镜像仓库,当镜像仓库不稳定或者停止服务的时候,Maven仍将无法访问被镜像仓库,因此将无法下载构件.
3. 仓库搜索服务:
   - Sonatype Nexus:
     - 地址: http://repository.sonatype.org
     - Nexus提供了关键字搜索, 类名搜索,坐标搜索,校验和搜索等功能.
   - Jarvana:
     - 地址: http://www.jarvana.com/jarvana
   - MVNbrowser:
     - 地址: http://www.mvnbrowser.com
   - MVNrepository:
     - 地址: http://mvnrepository.com

#### 0X06 生命周期和插件

1. 生命周期:
   - Maven的生命周期包括了项目的清理,初始化,编译,测试,打包.集成测试,验证,部署和站点生成等几乎所有构建步骤.
   - 三套生命周期:
     - Maven拥有三套相互独立的生命周期,它们分别为clean, default和site. clean生命周期的目的是清理项目,default生命周期的目的是构建项目,而site生命周期的目的是建立项目站点.
     - clean生命周期:
       - clean生命周期的目的是清理项目,它包含三个阶段:
         - pre-clean: 执行一些清理前需要完成的工作.
         - clean: 清理上一次构建生成的文件.
         - post-clean: 执行一些清理后需要完成的工作.
     - default生命周期:
       - default生命周期定义了真正构建时所需要执行的所有步骤.
         - validate
         - initialize
         - generate-sources
         - process-sources: 处理项目主资源文件.一般来说,是对src/main/resources目录内容进行变量替换等工作后,复制到项目输出的主classpath目录中.
         - generate-resources
         - process-resources
         - compile: 编译项目的主源码.一般来说,是编译src/main/java目录下的Java文件至项目输出的主classpath目录中.
         - process-classes
         - generate-test-sources
         - process-test-sources
         - test-compile: 编译项目的测试代码.一般来说,是编译src/test/java目录下的Java文件至项目输出的测试classpath目录中.
         - process-test-classes
         - test: 使用单元测试框架进行测试,测试代码不会被打包或部署.
         - prepare-package
         - package: 接受编译好的代码,打包成可发布的格式,如JAR.
         - pre-integration-test
         - integration-test
         - post-integration-test
         - verify
         - install 将包安装到Maven本地仓库,供本地其他Maven项目使用.
         - deploy: 将最终的包复制到远程仓库,供其他开发人员和Maven项目使用.
     - site生命周期:
       - site生命周期的目的是建立和发布项目站点.
         - pre-site: 执行一些在生成项目站点之前需要完成的工作.
         - site: 生成项目站点文档.
         - post-site:执行一些在生成项目站点之后需要完成的工作.
         - site-deploy: 将生成的项目站点发布到服务器上.
2. 命令行与生命周期:
   - mvn clean: 该命令调用clean生命周期的clean阶段.实际执行的阶段为clean生命周期的pre-clean和clean阶段.
   - mvn test: 该命令调用default生命周期的test阶段.实际执行的阶段为default生命周期的validate,initialize等,直到test的所有阶段.
   - mvn clean install: 该命令调用clean生命周期的clean阶段和default生命周期的install阶段.
   - mvn clean deploy site-deploy: 该命令调用clean生命周期的clean阶段,default生命周期的deploy阶段,以及site生命周期的site-deploy阶段.
3. 插件目标:
   - Maven的核心仅仅定义了抽象的生命周期,具体的任务是交由插件完成的,插件以独立的构件形式存在.
   - maven-dependencies-plugin有十多个目标,每个目标对应了一个功能,上述提到的功能分别对应插件目标为dependency:analyze, dependency:tree和dependency:list.冒号前面是插件前缀,冒号后面是该插件的目标.
4. 插件绑定:
   - Maven的生命周期与插件相互绑定,用以完成实际的构建任务.具体而言,是生命周期的阶段与插件的目标相互绑定,以完成某个具体的构建任务.
   - 内置绑定:
     - Maven在核心为一些主要的生命周期阶段绑定了很多插件的目标,当用户通过命令行调用生命周期阶段的时候,对应的插件目标就会执行相应的任务.
   - 自定义绑定:
     - 当多个插件目标绑定到同一个阶段的时候,这些插件声明的先后顺序决定了目标的执行顺序.
5. 插件配置:
   - 命令行插件配置:
     - 用户可以在Maven命令中使用-D参数,并伴随一个参数键=参数值的形式,来配置插件目标的参数.
     - 例: mvn install -Dmaven.test.skip=true
6. 插件解析机制:
   - 插件仓库:
     - 在需要的时候,Maven会从本地仓库寻找插件,如果不存在,则从远程仓库查找.找到插件之后,再下载到本地仓库使用.
     - 不同于repositories及其repository子元素,插件的远程仓库使用pluginRepositories和pluginRepository配置.

#### 0X07 聚合与继承

1. 我们会想要一次构建两个项目,而不是到两个模块的目录下分别执行mvn命令.Maven聚合这一特性就是为该需求服务的.
2. 对于聚合模块来说,其打包方式packaging的值必须为pom,否则就无法构建.
3. 为了方便用户构建项目,通常聚合模块放在项目目录的最顶层,其他模块则作为聚合模块的子目录存在,这样当用户得到源码时,第一眼发现的是聚合模块的POM,不用从多个模块中去寻找聚合模块来构建整个项目.
4. 聚合模块仅仅是帮助聚合其他模块构建的工具,它本身并无实质的内容.
5. 聚合模块与其他模块的目录结构并非一定要是父子关系.
6. 继承:
   - 在父POM中声明一些配置供子POM继承,以实现"一处声明,多处使用"的目的.
7. 反应堆:
   - 在一个多模块的Maven项目中,反应堆是指所有模块组成的一个构建结构.对于单模块的项目,反应堆就是该模块本身.
   - 构建顺序:
     - Maven按顺序读取POM,如果该POM没有依赖模块,那么就构建该模块,否则就先构建其依赖模块,如果该依赖还依赖于其他依赖模块,则进一步先构建依赖的依赖.
     - 模块间的依赖关系会将反应堆构成一个有向非循环图.各个模块是该图的节点,依赖关系构成了有向边.这个图不允许出现循环,因此当出现模块A依赖于B,而B又依赖于A的情况时,Maven就会报错.

#### 0X08 使用Nexus创建私服

1. Nexus分开分类的概念:
   - Maven可以直接从宿主仓库下载构件;Maven也可以从代理仓库下载构件,而代理仓库会间接地从远程仓库下载并缓存构件;最后,为了方便,Maven可以从仓库组下载构件,而仓库组没有实际内容,它会转向包含的宿主仓库或者代理仓库获得实际的构件.

#### 0X09 灵活的构建

1. Maven属性:
   - 通过<properties>元素用户可以自定义一个或多个Maven属性,然后在POM的其他地方使用${属性名称}的方式引用该属性.
   - Maven中共有6类属性:
     - 内置属性: 主要有两个常用的内置属性--${basedir}表示项目根目录,即包含pom.xml文件的目录;\${version}表示项目版本.
     - POM属性:用户可以使用该类属性引用POM文件中对应元素的值.
     - 自定义属性:用户可以在POM的<properties>元素下自定义Maven属性.
     - Settings属性:与POM属性同理,用户使用以settings开头的属性引用settings.xml文件中设置XML元素的值.
     - Java系统属性: 所有Java系统属性都可以使用Maven属性引用.
     - 环境变量属性: 所有环境变量都可以使用以env.开头的Maven属性引用.



















































































































