#!/bin/sh
mysql -h0 -P9306 -e "select * from $1 where match('$2'); show meta;"
