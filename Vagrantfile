# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/xenial64"
  config.vm.network "private_network", ip: "192.168.99.3"
  # config.vm.synced_folder "../data", "/vagrant_data"
  
  config.vm.provider "virtualbox" do |vb|
    vb.name = "owaspth-workshop-2"
    vb.gui = false
    vb.memory = "1024"
  end

  config.vm.provision "shell", inline: <<-SHELL
    echo 'root:password' | chpasswd
    apt-get update
    apt-get install -y python
  SHELL
end
