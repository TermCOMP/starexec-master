#!/bin/sh
sed -e 's/\(WORST_CASE([^,]*,.*)\)/"\1"/' $*
