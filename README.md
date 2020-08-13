### Lilac
#### app graphql部分
#### 总体约定
* 后端:
1. 所有请求的`headers`中包含 `device-id`
2. 服务器端逻辑错误返回(非字段验证类)格式为 `代码@提示信息`,提示信息为中文,可以直接引用,如: `429@请于118秒后重试`
3. cors已经配置
4. 采用laravel scancum认证
5. 目录: 路由- `/graphql`; 自定义类(涉及检验规则) - `/app/GraphQL/Scalars`; 逻辑处理文件 - `/app/GraphQL/Queries`(查询), `/app/GraphQL/Mutations`(变异)
##### 身份认证部分(注释请忽略)
* 
```
input trustMoblieInput { # 极光,暂不考虑
    jv_token: String! 
}

input SendSmsCodeInput {
    mobile: ChineseMobile! # 手机号,规则可见 /app/GraphQL/Scalars/ChineseMobile.php
}

input GetTokenInput {
    mobile: ChineseMobile!
    code: SmsCode! # 验证码
}

type SendSmsResault {
    registered: Boolean! # 是否为已注册用户
    success: Boolean! # 是否成功
}

type TokenPayload {
    token: String! # 令牌,置于http headers中
}

type LogoutResault {
    success: Boolean! # 退出, 是否成功
}

```
* 方法
```
type Query { # 查询
    users: [User!]! @all # 所有用户
    user(id: ID @eq): User @find # 按id查询用户 
    # sample
    # orgs: [Org!]! @all
    # org(id: ID @eq): Org @find
    # discoveries: [Discovery!]! @all
}

# 需要认证
extend type Query @guard { # 需要身份认证的查询
    me: User @auth
}

type Mutation {
    trustMoblie(input: trustMoblieInput! @spread) : TokenPayload!
    sendSmsCode(input: SendSmsCodeInput! @spread) : SendSmsResault!
    getToken(input: GetTokenInput! @spread) : TokenPayload!
    logout: LogoutResault!
}
extend type Mutation @guard { # 需要身份认证的变异
    # 如关注
}

```