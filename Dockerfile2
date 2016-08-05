FROM ansible/ubuntu14.04-ansible:stable

RUN echo "IdentityFile ~/.ssh/id_rsa" >> /etc/ssh/ssh_config

RUN echo "IdentityFile ~/.gitconfig" >> /root/.gitconfig

# Add your playbooks to the Docker image
ADD . /srv/citope
WORKDIR /srv/citope

# Execute Ansible with your playbook's primary entry point.
# The "-c local" argument causes Ansible to use a "local connection" that won't attempt to
# ssh in to localhost.
RUN ansible-playbook utils/ansible/playbook.yml -c local

