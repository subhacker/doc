# 在线教育平台 数据库 描述文档

目录：

* [通用](#通用)
* [学生](#学生)
* [课程](#课程)
* [教师](#教师)
* [上课](#上课)
* [工作人员](#工作人员)

---

## 通用
---
### 1.1 基础用户

表名：
`base_user`

字段：
- id  
- username 用户名
- password 密码
- sale 加盐值
- gmt_password_modified 密码最后修改时间
- token 鉴权码
- token_created_time 鉴权码生成时间
- gmt_create <<账号创建时间
- creator
- gmt_modified
- modifier

### 1.2 数据字典

表名：
`data_dictionary`

字段：
- id
- group 分类
- code 编码
- content 内容
- gmt_create
- creator
- gmt_modified
- modifier

---
### 消息队列

表名：
`message`

字段：
- id
- message 消息
- type 类型
- time 时间
- status 状态
- gmt_create
- creator
- gmt_modified
- modifier

---
## 学生
---
### 2.1 学生

表名：
`student`

字段：
- id
- base_user_id 用户id
- telphone 手机号
- nickname 昵称
- gender 性别
- birthday 出生日期
- level 等级
- gmt_create
- creator
- gmt_modified
- modifier

---
### 2.2 学生账户 <red>__?__</red>

表名：
`student_account`

字段：
- id
- student_id 学生id
- blance 余额
- currency 币种
- gmt_create
- creator
- gmt_modified
- modifier

---
### 2.3 学生消费记录

表名：
`student_consumption_record`

字段：
- id
- student_id 学生id
- amount 金额
- currency 币种
- consumer_product_id 消费产品id
- consumption_time 消费时间
- consumption_type 消费类型
- consumption_desc 消费备注
- gmt_create
- creator
- gmt_modified
- modifier

---
### 2.4 学生充值记录

表名：
`student_payment_record`

字段：
- id
- student_id 学生id
- student_account_id 学生账户id
- amount 金额
- payment_method 支付方式
- transaction_flow_number 交易流水号
- currency 币种
- return_code 返回状态码
- return_msg 返回信息
- payment_time 支付时间
- payment_type 支付类型
- payment_desc 支付备注
- gmt_create
- creator
- gmt_modified
- modifier

---
### 2.5 分级测试 <red>__?__</red>

表名：
`grading_test` 

字段：
- id
- gmt_create
- creator
- gmt_modified
- modifier

---
### 2.6 分级测试结果

表名：
`grading_test_result`

字段：
- id
- student_id 学生id
- grading_test_id 分级测试id
- score 分数
- level 等级
- desc 备注
- gmt_create
- creator
- gmt_modified
- modifier

---
## 3课程
---
### 3.1 课程 <red>__?__</red>

表名：
`curriculum`

字段：
- id
- level 等级
- pic_uri 图片路径
- overview 概述
- outline 大纲
- gmt_create
- creator
- gmt_modified
- modifier

---
### 3.2 课程单元

表名：
`curriculum_unit`

字段：
- id
- unit_name 单元名称
- grade_id 课程等级id
- pic_uri 图片路径
- overview 概述
- gmt_create
- creator
- gmt_modified
- modifier

---
### 3.3 课程章节

表名：
`curriculum_chapter`

字段：
- id
- curriculum_id 课程id
- unit_id 单元id
- practice_id 练习id
- handout_id 讲义id
- overview 概述
- gmt_create
- creator
- gmt_modified
- modifier

---
### 3.4 练习

表名：
`practice`

字段：
- id
- curriculum_id 课程id
- unit_id 单元id
- curriculum_id 章节id
- practice_zip_uri 练习压缩包路径
- editor 作者
- overview 概述
- desc 备注
- gmt_create
- creator
- gmt_modified
- modifier

---
### 3.5 讲义

表名：
`handout`

字段：
- id
- curriculum_id 课程id
- unit_id 单元id
- curriculum_id 章节id
- handout_json 讲义json
- handout_pdf_uri 讲义pdf路径
- editor 作者
- desc 备注
- gmt_create
- creator
- gmt_modified
- modifier

备注：
```javascript
// 讲义 json 格式范例
[
    {
        title: "标题1",
        content: [
            "段落1",
            "段落2",
            "段落3"
        ]
    }, {
        title: "标题2",
        content: [
            "段落1",
            "段落2",
            "段落3"
        ],
        image: [
            "//image1.jpg",
            "//image2.jpg"
        ]
    }, {
        title: "标题3",
        image: [
            "//image3.jpg",
            "//image4.jpg"
        ]
    }
]
```

---
### 3.6 教室

表名：
`classroom`

字段：
- id
- uri 教室连接
- status 教室状态
- gmt_create
- creator
- gmt_modified
- modifier

---
### 3.8 课类型

表名：
`lesson_type`

字段：
- id
- lesson_id 课id
- type_name 类型名
- type_code 类型编号
- gmt_create
- creator
- gmt_modified
- modifier

---
## 教师
---
### 4.1 教师

表名：
`teacher`

字段：
- id
- base_user_id 用户id
- worker_id 工作人员id（教学专员）
- email 邮箱
- name 姓名
- gender 性别
- birthday 出生日期
- level 等级
- status 状态
- gmt_create
- creator
- gmt_modified
- modifier

---
### 4.2 非正式教师

表名：
`informal_teacher`

字段：
- id
- base_user_id 用户id
- email 邮箱
- name 姓名
- gender 性别
- birthday 出生日期
- level 等级
- status 状态
- gmt_create
- creator
- gmt_modified
- modifier

---
### 4.3 教师银行卡

表名：
`teacher_bank_card`

字段：
- id
- teacher_id 教师id
- bank_code 银行编码
- card_code 银行卡号
- holder_name 持有人姓名
- is_default 是否默认银行卡
- gmt_create
- creator
- gmt_modified
- modifier

---
### 4.4 学生对教师评价表

表名：
`student_teacher_evaluation`

字段：
- id
- teacher_id 教师id
- student_id 学生id
- json_content 评价内容
- gmt_create
- creator
- gmt_modified
- modifier

---
### 4.5 工作人员对教师评价表

表名：
`worker_teacher_evaluation`

字段：
- id
- teacher_id 教师id
- worker_id 工作人员id
- json_content 评价内容
- gmt_create
- creator
- gmt_modified
- modifier

---
### 4.6 试讲教室

表名：
`trial_classroom`

字段：
- id
- classroom_id 教室id
- teacher_id 教师id
- worker_id 工作人员id（hr）
- gmt_create
- creator
- gmt_modified
- modifier

---
### 4.7 教师授课时段 <red>__?__</red>

表名：
`teacher_give_lessons_time`

字段：
- id
- teacher_id 教师id
- day_of_weeks 星期几
- time_of_day 第几节课
- gmt_create
- creator
- gmt_modified
- modifier

---
### 4.8 教师请假时段 <red>__?__</red>

表名：
`teacher_leave_time`

字段：
- id
- teacher_id 教师id
- start_leave 请假开始时间
- stop_leave 请假结束时间
- worker_id 工作人员id（教学专员）
- gmt_create
- creator
- gmt_modified
- modifier

---
### 4.9 教师收支明细

表名：
`teacher_account_details`

字段：
- id
- teacher_id 教师id
- teacher_bank_card_id 教师银行卡id
- amount 金额
- transaction_flow_number 交易流水号 <red>__?__</red>
- currency 币种
- time 时间
- type 类型
- desc 备注
- gmt_create
- creator
- gmt_modified
- modifier

---
## 上课
---
### 5.1 课

表名：
`lesson`

字段：
- id
- curriculum_id 课程id
- unit_id 单元id
- curriculum_id 章节id
- teacher_id 教师id
- classroom_id 教室id
- day_of_weeks 星期几
- time_of_day 第几节课
- class_time_start_time 上课时间
- class_time_stop_time 下课时间
- evaluation_id 评价id
- status 状态
- gmt_create
- creator
- gmt_modified
- modifier

备注：
- 由排课逻辑生成


---
### 5.2 替补教师

表名：
`substitute_teacher`

字段：
- id
- teacher_id 教师
- lesson_id 课id
- status 状态
- gmt_create
- creator
- gmt_modified
- modifier

备注：
- 由排课逻辑生成

---
### 5.3 约课

表名：
`appointment_lesson`

字段：
- id
- student_id 学生id
- lesson_id 课id
- gmt_create
- creator
- gmt_modified
- modifier

---
### 5.4 取消课程申请

表名：
`cancel_course_application`

字段：
- id
- teacher_id 教师id
- lesson_id 课id
- worker_id 工作人员id
- status 状态
- application_time 申请时间
- gmt_create
- creator
- gmt_modified
- modifier

---
## 工作人员
---
### 6.1 工作人员

表名：
`worker`

字段：
- id
- base_user_id 用户id
- employee_code 工号
- name 姓名
- telphone 电话
- role_id 角色id
- gmt_create
- creator
- gmt_modified
- modifier

---
### 6.2 角色

表名：
`role`

字段：
- id
- role_code 角色编码
- gmt_create
- creator
- gmt_modified
- modifier

---
### 6.3 权限

表名：
`permission`

字段：
- id
- role_id 角色id
- permission_name 权限名
- interface 可访问接口
- gmt_create
- creator
- gmt_modified
- modifier

---
### 6.4 常见问题

表名：
`faq`

字段：
- id
- problem 问题
- reply 回答
- type 类型
- gmt_create
- creator
- gmt_modified
- modifier

---
### 6.5 投诉

表名：
`complaint`

字段：
- id
- complainant_id 投诉人
- worker_id 工作人员id（客服）
- content 投诉内容
- type 类型
- status 状态
- desc 备注
- reply 回复
- gmt_create
- creator
- gmt_modified
- modifier
