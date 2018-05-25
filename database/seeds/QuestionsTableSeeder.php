<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;
        $question = Question::create(
            [
            'title' => '前端工程师的技术进阶点在哪里?',
            'description' => <<<'EOT'
这个问题是一个比较全能的Java工程师提出来的,总结一下大家的回答：

需求变化快,需要良好的复用、可拓展能力，否则动不动重写。
兼容性问题,需要兼容各种移动设备的各种浏览器。
CSS非正交,对于绝大多数人来说属于『玄学』。


那么问题来了,普通前端工程师的技术进阶突破点在什么地方?

有哪些方向可以突破,以后端为例

全局方向: 做业务整体架构
深度方向: 做性能调优、高并发、分布式等专业要求很高的领域
延伸方向: 以Java 为例很多大神转移到大数据、分布式计算这个方面，算是传统Java Web的延伸方向
EOT
,
            'user_id' => $i,
        ]);
        $question->answers()->create([
            'user_id' => ++$i,
            'content' => <<<'EOT'
基于上面这个我个人认为的前提，我觉得前端的技术进阶并不像 Java 那样，对技术本身有很深度的研究，我个人规划更倾向于选择偏业务性的突破点：快速学习技术的能力前端时不时出来很多新东西，然后总是先于当前实现写未来代码，快速学习新事物的能力是最基础的。出来的新东西，能不能快速了解用法、特性、适用场景和底层实现？这是后面的基础。突破方法：对新事物保持好奇而非恐惧和抵触，跳出舒适区掌握学习的方法论，比如先看文档、再跑 Demo、提出问题、源码验证学习一些学习技巧业务抽象能力和技术选型、设计能力一个产品不是一夜建设出来的，但前端可以加速这个过程。使用 Node.js 可以写一个 index.js 文件执行下就跑起来一个各种功能的 Web 服务器，这个时间放在 Java 可能刚用 Spring Boot 创建好项目目录？
EOT
        ]);

    }
}
