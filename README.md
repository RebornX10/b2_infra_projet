# Project Infra SI

## Server Monitoring

### Samuel Adone & Marie Dugoua

---

- **Tabs  :**
  - Admin (monitoring)
  - User (manage server)

---

- **Features**:
  - User/Admin :
    - Add server
    - Connection server
    - Delete server
    - View how many people in server
  - User : 
    - Manage server (change weather, date/hour, items)
  - Admin : 
    - Manage access
    - Manage User
    - Manage connection
  - *Specs* 
    - RAM 2Gb 

------

##### How to install

1. **Vagrant**

   First you need to install an hypervisor (VirtualBox, HyperV ..), we used and do our installation with [VirtualBox](https://www.virtualbox.org/wiki/Downloads).

   After we need to install [Vagrant](https://www.vagrantup.com/), install the right [package](https://www.vagrantup.com/downloads) for your OS. After installing Vagrant, verify the installation worked by opening a console, and checking that `vagrant` is available. Like following :

   ```bash
   $ vagrant
   Usage: vagrant [options] <command> [<args>]
   
       -v, --version                    Print the version and exit.
       -h, --help                       Print this help.
   
   # ...
   ```

   

2. **Apache server**

   Install an apache server that works in your Os by following the next link [Wamp](https://www.wampserver.com/) for windows, [Lamp](https://doc.ubuntu-fr.org/lamp) for Linux and [Mamp](https://www.mamp.info/fr/mamp/mac/) for MacOs.

3. **Code source**

   You'll find our code in th repository git hub [RebornX10](https://github.com/RebornX10/b2_infra_projet), by follow the next command line you'll clone the repository on your machine:

   ```bash
   # go to the directory you want
   $ cd [nameOfDirectory]/
   
   # and clone our repo
   $ git clone https://github.com/RebornX10/b2_infra_projet.git
   ```



##### How to config

1. **Vagrant**

   Do as the following code line:

   ```bash
   #on linux
   $ ip a
   
   # look for "eth0" or "wlan0" and copy the IP address and the name of the adapter
   ```

   ```bash
   #on mac os
   $ ifconfig
   
   # look for "en0" and copy the IP address and the name of the adapter
   ```

   ```bash
   #on windows
   $ ipconfig
   
   # look for "Ethernet" and copy the IP address and the name of the adapter
   ```

   Open with vim or nano the vagrant file in our directory.

   ```bash
   $ cd ./b2_infra_projet/vagrant_stuff/
   
   $ vim vagrantfile
   ```

   Find the following line  and change "bridge" and "ip" by yours:

   ```bash
   config.vm.network "public_network", bridge: "wlan0", ip: "192.168.0.99"
   ```



##### How to launch

Open a new console, go to the directory as following:

```bash
$ cd ./b2_infra_projet/

$ vagrant up
[...]
$ vagrant ssh
[...]
$ ./start
```

Congratulations now you have a server.