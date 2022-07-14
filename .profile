past="Y2018 Y2019 Y2020 Y2021"
current=Y2022
for c in $past $current
do
  cp index-wait.html $c/index.html
done
for c in $past
do
  ./generate.sh $c&
done
while [ 1 ]; do
  echo Refreshing...
  ./generate.sh $current refresh
  echo Done! Sleeping...
  sleep 5
done&
