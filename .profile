if [ -z "$1" ]; then
  current=Y2024
else
  current=$1
fi
cp index-wait.html $current/index.html
while [ 1 ]; do
  echo Pulling...
  git pull origin master
  echo Refreshing...
  ./generate.sh $current refresh
  echo Done! Sleeping...
  sleep 5
done
