past="Y2018 Y2019 Y2020 Y2021 Y2022"
current=Y2023
for c in $past $current
do
  cp index-wait.html $c/index.html
done
for c in $past
do
  ./generate.sh $c
done&
while [ 1 ]; do
  echo Refreshing...
  ./generate.sh $current refresh team-ranking
  echo Done! Sleeping...
  sleep 5
done&
