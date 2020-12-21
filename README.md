# Termination Competition Web Interface
This is a light-weight StarExec presenter using PHP.

## Registration

The registration procedure is as follows.
1. Register at StarExec:
   1. Join the Termination Community:
      Please provide sufficient information so that the organizer can **identify you**,
      and be convinced that you will **use StarExec for research related to termination**.
   1. Upload your solver and remember *configuration id*s.
1. Edit Y20XX_info.php, where 20XX is the current year, so that a line
   ```
        'Tool' => 1234,
   ```
   is in the 'participants' component of the category you participate,
   where `Tool` is replaced by a short name of your tool and `1234` by the configuration id. Then please make *pull request*.

