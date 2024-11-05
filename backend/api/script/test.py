import subprocess
import sys
verif=sys.argv[1]
#subprocess.Popen(r"C:\Users\DELL\anaconda3\Scripts\activate")
# Path to a Python interpreter that runs any Python script
# under the virtualenv /path/to/virtualenv/
python_bin = (r"C:\Users\DELL\anaconda3\envs\chatbot\python")

# Path to the script that must run under the virtualenv
script_file = (r"C:\xampp\htdocs\tutoriel\api\script\train.py")

subprocess.Popen([python_bin, script_file,verif])