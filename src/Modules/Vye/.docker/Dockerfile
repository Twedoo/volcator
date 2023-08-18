FROM node:16.17
USER node
RUN mkdir -p /home/node/app
WORKDIR /home/node/app
COPY . /home/node/app
RUN yarn install
CMD ["yarn", "run", "start"]
