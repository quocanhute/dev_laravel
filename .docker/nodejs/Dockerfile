FROM node:20-alpine
WORKDIR /app
RUN npm install -g pm2
COPY ["package.json", "package-lock.json*", "./"]
RUN npm install --production --silent
COPY . .
RUN cat /etc/group
RUN addgroup -g 1002 formdent
RUN adduser -D -u 1002 formdent -G formdent
RUN chown -R formdent:formdent /app
USER formdent
CMD ["pm2-runtime", "ecosystem.config.js", "--env", "production"]