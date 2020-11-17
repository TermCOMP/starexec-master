#!/bin/sh
# bugfix to StarExec CSV output
sed -e 's/\(WORST_CASE([^,]*,.*)\)/"\1"/' -i $1