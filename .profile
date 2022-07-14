competition=Y2022
cp index-wait.html $competition/index.html
while [ 1 ]; do
  echo Refreshing...
  ./generate.sh $competition refresh
  echo Done! Sleeping...
  sleep 5
done&
