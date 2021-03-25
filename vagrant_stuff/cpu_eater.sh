#!/bin/bash
#Name: cpu_usage.sh
#Description: Script to check top cpu consuming process for 1 hour

#Change the SECS to total seconds to monitor CPU usage.
#UNIT_TIME is the interval in seconds between each sampling


function report_utilisation {
  # Process collected data
  echo
  echo CPU eaters :

  cat /tmp/cpu_usage.$$ | 
awk '
{ process[$1]+=$2; }
END{
  for(i in process)
  {
    printf("%-20s %sn",i, process[i]) ;
  }

   }' | sort -nrk 2 | head

#Remove the temporary log file
rm /tmp/cpu_usage.$$
exit 0
}

trap 'report_utilisation' INT

SECS=30
UNIT_TIME=10

STEPS=$(( $SECS / $UNIT_TIME ))

echo Watching CPU usage... ;

# Collect data in temp file
for((i=0;i<$STEPS;i++)); do
    ps -eocomm,pcpu | egrep -v '(0.0)|(%CPU)' >> /tmp/cpu_usage.$$
    sleep $UNIT_TIME
done

report_utilisation
