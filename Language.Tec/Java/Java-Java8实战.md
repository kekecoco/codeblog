Java8实战

##### 0X01 通过行为参数化传递代码

1. 行为参数化可以帮助你处理频繁变更的需求的一种软件开发模式.
2. 行为参数化还是在于你可以把迭代要筛选集合的逻辑与对集合中每个元素应用的行为区别开.

##### 0X02 Lambda表达式

1. Lambda表达式: 可传递的匿名函数的一种方式;它没有名称,但它有参数列表,函数主体,返回类型,可能还有一个可以抛出异常的异常列表.

2. Lambda表达式由参数,箭头和主体组成.

   ```java
   (Apple a1, Apple a2) -> a1.getWeight().compareTo(a2.getWeight());
        参数            箭头                    主体  
   ```

3. Lambda的基本语法:

   ```java
   (parameters) -> express
   or
   (parameters) -> {statements;}
   ```

   *注: 如果是语句需要使用花括号括起来.*

4. 函数式接口: 只定义一个抽象方法的接口.

   *注: 只要接口只定义了一个抽象方法,它就是一个函数式接口.*

5. 函数描述符: 描述Lambda和函数式接口的签名.Runnable接口的签名是() -> void.

6. Lambda仅可用于上下文是函数式接口的情况.

7. 抽象方法的签名可以描述Lambda表达式的签名.

8. 函数式接口的抽象方法的签名称为函数描述符.

9. 使用局部变量:

   * Lambda表达式允许使用自由变量,是在外层作用域中定义的变量.
   * Lambda表达式只能捕获指派给它们的局部变量一次.局部变量必须显式声明为final,或事实上是final.
   * 对局部变量的限制:
     * 实例变量和局部变量背后的实现有一个关键不同.实例变量都存储在堆中,而局部变量则保存在栈上.如果Lambda可以直接访问局部变量,而且Lambda是在一个线程中使用的,则使用Lambda的线程,可能会在分配该变量的线程将这个变量收回之后,去访问该变量.因此,Java在访问自由局部变量时,实际上是在访问它的副本,而不是访问原始变量.如果局部变量仅仅赋值一次那就没有什么区别了—因此就有了这个限制. 

10. 方法引用:

   - 针对仅仅涉及单一方法的Lambda的语法糖.

11. 如何构建方法引用:

    - 指向静态方法的方法引用(例如Integer的parseInt方法,写作Integer::parseInt).
    - 指向任意类型实例方法的方法引用(例如String的length方法,写作String::length).
    - 指向现有对象的实例方法的方法引用(假设你有一个局部变量expensiveTransaction用于存放Transaction类型的对象,它支持实例方法getValue,那么你就可以写expensiveTransaction::getValue).

#### 0X03 函数式数据处理

1. 流是什么: 流是Java API的新成员,它允许你以声明的方式处理数据集合.此外,流还可以透明地并行处理.
2. 流的定义: 从支持数据处理操作的源生成的元素序列.
   - 元素序列: 流提供一个接口,可以访问特定元素类型的一组有序值.流的目的在于表达计算.
   - 源: 流会使用一个提供数据的源.从有序集合生成流时会保留原有的顺序.
   - 数据处理操作: 流的数据处理功能支持类似于数据库的操作,以及函数式编程语言中的常用操作.流操作可以顺序执行,也可以并行执行.
   - 流操作有两个重要的特点:
     - 流水线: 很多流操作本身会返回一个流,这样多个操作就可以链接起来.形成一个大的流水线.
     - 内部迭代: 与使用迭代器显式迭代的集合不同,流的迭代操作是在背后进行的.
3. 流与集合:
   - 集合与流之间的差异就在于什么时候进行计算.
   - 集合是一个内存中的数据结构,它包含数据结构中目前所有的值.集合中的每个元素都得先计算出来才能添加到集合中.
   - 流是在概念上固定的数据结构,其元素则是按需计算的.
   - 和迭代器类似,流只能遍历一次.遍历完之后,我们就说这个流已经被消费掉了.
4. 外部迭代与内部迭代:
   - 使用Collection接口需要用户去做迭代(比如用for-each),这称为外部迭代.
   - Streams库使用内部迭代,它帮你把迭代做了,还把得到的流值存在了某个地方,你只要给出一个函数说要干什么就可以了.
5. 流操作:
   - 可以连接起来的操作称为中间操作,关闭流的操作称为终端操作.
   - 中间操作:
     - 除非流水线出发一个终端操作,否则中间操作不会执行任何处理.
   - 终端操作:
     - 终端操作会从流的流水线生成结果.其结果是任何不是流的值.
   - 使用流:
     - 一个数据源来执行一个查询.
     - 一个中间操作链,形成一条流的流水线.
     - 一个终端操作,执行流水线,并能生成结果.

#### 0X04 使用流

1. 用谓词筛选:
   - Streams接口支持filter方法.该操作会接受一个谓词(一个返回Boolean的函数)作为参数,并返回一个包含所有符合谓词的元素的流.
2. 筛选各异的元素:
   - 流还支持一个叫做distinct的方法,它会返回一个元素各异(根据流所生成元素的hashCode和equals方法实现)的流.
3. 截短流:
   - 流支持limit(n)方法,该方法会返回一个不超过给定长度的流.所需的长度作为参数传递给limit.如果流是有序的,则最多返回前n个元素.
   - limit也可以用在无序流上.这种情况下,limit的结果不会以任何顺序排列.
4. 跳过元素:
   - 流还支持skip(n)方法,返回一个扔掉了前n个元素的流.
5. 对流中每一个元素应用函数:
   - 流支持map方法,它会接受一个函数作为参数.这个函数会被应用到每个元素上,并将其映射成一个新的元素.
6. 流的扁平化:
   - 使用flatMap方法的效果是,各个数组并不是分别映射成一个流,而是映射成流的内容.
   - 所有使用map(Arrays::stream)时生成的单个流都被合并起来.即扁平化为一个流.
   - flatMap方法让你把一个流中的每个值都换成另一个流,然后把所有的流连接起来成为一个流.
7. 检查谓词是否至少匹配一个元素:
   - anyMatch方法可以回答"流中是否有一个元素能匹配给定的谓词".
8. 检查谓词是否匹配所有元素:
   - allMatch方法的工作原理和anyMatch类似,但它会看看流中的元素是否都能匹配给定的谓词.
   - 和allMatch相对的是noneMatch.它可以确保流中没有任何元素与给定的谓词匹配.
   - 注: anyMatch, allMatch和noneMatch这三个操作都用到了我们所谓的短路.
9. 查找元素:
   - findAny方法将返回当前流中的任意元素.
   - 查找第一个元素:
     - findFirst:用于查找第一个元素.
   - 何时使用findFirst和findAny:
     - 找到第一个元素在并行上限制更多.如果你不关心返回的元素是哪个,请使用findAny,因为它在使用并行流时限制较少.
10. 归约:
   - 元素求和:
     - 有初始值:
       - int sum = numbers.stream().reduce(0, Integer::sum);
     - 无初始值(reduce还有一个重载的变体,它不接受初始值,但是会返回一个Optional对象):
       - Optional<Integer> sum = numbers.stream.reduce((a,b) -> (a + b));
       - reduce操作无法返回其和,因为它没有初始值.这就是为什么结果被包裹在一个Optional对象里,以表明和可能不存在.
   - 最大值和最小值:
     - 最大值: Optional<Integer> max = numbers.stream().reduce(Integer::max);
     - 最小值:Optional<Integer> min = numbers.stream().reduce(Integer::min);
11. 数值流:
    - Stream API提供了原始类型流特化,专门支持处理数值流的方法.
    - 原始类型流特化:
      - Java8引入了三个原始类型特化流接口来解决这个问题: IntStream, DoubleStream和LongStream,分别将流中的元素特化为int, long和double,从而避免了暗含的装箱正本.
      - 映射到数值流:
        - 将流转换为特化版本的常用方法是mapToInt, mapToDouble和mapToLong.这些方法和前面说的map方法的工作方式一样,只是它们返回的是一个特化流,而不是Stream<T>.
        - int calories = menu.stream().mapToInt(Dish::getCalories).sum();
      - 转换回对象流:
        - 要把原始流转换成一般流,可以使用boxed方法.
        - IntStream intStream = menu.stream().mapToInt(Dish::getCalories);
        - Stream<Integer> stream = intStream.boxed();
      - 默认值OptionalInt:
        - Optional可以用Integer,String等参考类型来参数化.对于三种原始流特化,也分别有一个Optional原始类型特化版本:OptionalInt, OptionalDouble和OptionalLong.
        - OptionalInt maxCalories = menu.stream().mapToInt(Dish::getCalories).max();
        - 现在,如果没有最大值的话,你就可以显式处理OptionalInt去定义一个默认值了.
        - int max = maxCalories.orElse(1);
    - 数值范围:
      - Java8引入了两个可以用于IntStream和LongStream的静态方法,帮助生成这两种范围:range和rangeClosed.这两个方法都是第一个参数接受起始值,第二个参数接受结束值.但range是不包含结束值的,而rangeClosed则包含结束值.
      - IntStream evenNumbers = IntStream.rangeClosed(1,100).filter(n -> n % 2 == 0);
12. 构建流:
    - 由值创建流:
      - 可以使用静态方法Stream.of,通过显式值创建一个流.它可以接受任意数量的参数.
      - Stream<String> stream = Stream.of("Java 8 ", "Lambdas ", "In ", "Action");
      - Stream.map(String::toUpperCase).forEach(System.out::println);
    - 由数组创建流:
      - 可以使用静态方法Arrays.stream从数组创建一个流.它接受数组作为参数.
      - int[] numbers = (2, 3, 5, 7, 11, 13);
      - Int sum = Arrays.stream(numbers).sum();
    - 由文件生成流:
      - Java中用于处理文件等I/O操作的NIO API已更新,以便利用Stream API.java.nio.file.Files中的很多静态方法都会返回一个流.
    - 由函数生成流:创建无限流:
      - Stream API提供了两个静态方法来从函数生成流: Stream.iterate和Stream.generate.这两个操作可以创建所谓的无限流.

#### 0X06 用Optional取代null

1.  Java8中引入了一个新的类java.util.Optional<T>.这是一个封装Optional值的类.
2. 变量存在时,Optional类只是对类简单封装.变量不存在时,缺失的值会被建模成一个"空"的Optional对象,由方法Optional.empty()返回.Optional.empty()是一个静态工厂方法,它返回Optional类的特定单一实例.
3. 如果尝试引用一个null,一定会出发NullPointException,不过使用Optional.empty()就完全没事,它是Optional类的一个有效对象,多种场景都能调用.
4. 应用Optional的几种模式:
   - 创建Optional对象:
     - 声明一个空的Optional: Optional<Car> optCar = Optional.empty();
     - 依据一个非空值创建Optional: Optional<Car> optCar = Optional.of(car);
       - 注: 如果car是一个null,这段代码会立即抛出一个NullPotionException,而不是等到你试图访问car的属性值时才返回一个错误.
     - 可接受null的Optional: Optional<Car> optCar = Optional.ofNullable(car);
       - 注:如果car是null,那么得到的Optional对象就是空对象.
5. 使用Optional的实战示例:
   - 用Optional封装可能为null的值:
     - Optional<Object> value = Optional.ofNullable(map.get("key"));

