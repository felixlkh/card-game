FROM node

RUN mkdir /project
WORKDIR /project

# add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH

COPY package.json /project/package.json

COPY . /project

RUN npm install
RUN npm install -g @angular/cli

# start app
CMD ng serve --host 0.0.0.0
