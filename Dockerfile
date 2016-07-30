FROM ansible/ubuntu14.04-ansible:stable


# alternative way to add user
# RUN adduser --disabled-password --gecos '' docker

# RUN useradd -ms /bin/bash docker
# USER docker


# RUN useradd -m docker && echo "docker:docker" | chpasswd && adduser docker sudo
# USER docker
# WORKDIR /home/docker
# CMD /bin/bash

RUN echo "IdentityFile ~/.ssh/id_rsa" >> /etc/ssh/ssh_config

RUN echo "IdentityFile ~/.gitconfig" >> /root/.gitconfig

# Add your playbooks to the Docker image
ADD . /srv/citope
WORKDIR /srv/citope

# Execute Ansible with your playbook's primary entry point.
# The "-c local" argument causes Ansible to use a "local connection" that won't attempt to
# ssh in to localhost.
RUN ansible-playbook utils/ansible/playbook.yml -c local

EXPOSE 443
ENTRYPOINT ["/usr/local/bin/citope"]
CMD ["--help"]


FROM httpd:2.4
COPY ./public-html/ /usr/local/apache2/htdocs/
