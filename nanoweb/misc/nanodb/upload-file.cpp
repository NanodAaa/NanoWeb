#include <iostream>
#include <mysql/mysql.h>

int main() {
    MYSQL* conn;
    MYSQL_RES* res;
    MYSQL_ROW row;

    // 初始化 MySQL 连接
    conn = mysql_init(NULL);

    // 连接到 MySQL 数据库
    if (!mysql_real_connect(conn, "localhost", "username", "password", "dbname", 0, NULL, 0)) {
        std::cerr << "连接到 MySQL 失败: " << mysql_error(conn) << std::endl;
        return 1;
    }

    // 执行 SQL 查询
    if (mysql_query(conn, "SELECT * FROM your_table")) {
        std::cerr << "执行查询失败: " << mysql_error(conn) << std::endl;
        mysql_close(conn);
        return 1;
    }

    // 获取查询结果集
    res = mysql_store_result(conn);
    if (!res) {
        std::cerr << "获取结果集失败: " << mysql_error(conn) << std::endl;
        mysql_close(conn);
        return 1;
    }

    // 输出查询结果
    while ((row = mysql_fetch_row(res))) {
        std::cout << "Field1: " << row[0] << ", Field2: " << row[1] << std::endl;
        // 根据实际情况输出其他字段
    }

    // 释放结果集内存
    mysql_free_result(res);

    // 关闭 MySQL 连接
    mysql_close(conn);

    return 0;
}
